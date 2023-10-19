<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\Registration;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Session;

class ClassService {

    public function findClass($id) {

        if(!$class = Classes::with('instructor')->with('modality')->find($id)) {
            throw new Exception('Aula não encontrada');
        }

        return $class;
    }

    public function storeClass(Registration $registration, $data) {

        $data['modality_id'] = $registration->modality_id;
        $data['registration_id'] = $registration->id;
        $data['student_id'] = $registration->student_id;

        $data['status'] = 0;

        if(!is_null($data['situation'])) {
            $data['status'] = 1;
        }
        

        if(!$class = Classes::create($data)) {
            throw new Exception('Não foi possível cadastrar a aula');
        }


        Session::flash('success', 'Aula cadastrada');

        return $class;

    }

    public function storeExperimentalClass($data) {
        $data['status'] = 0;


        try {
            $data['status'] = 0;
            Classes::create($data);

            if(isset($data['value'])) {
                Transaction::create([
                    'value' => $data['value'],
                    'type' => 'R',
                    'category_id' => 6,
                    'date' => $data['date'],
                    'description' => 'Aula Exp. ' . $data['name']
                ]);  
            }

        } catch (\Exception $e) {
            Session::flash('error', 'Não foi possível agendar a aula. ('. $e->getMessage().')');
        }

        Session::flash('success', 'Aula experimental agendada com sucesso!');

        return true;
        
    }

    public function updateClass(Classes $class, $data) {

        $data['status'] = 0;

        if(!is_null($data['situation'])) {
            $data['status'] = 1;
        }

        if(!$class->fill($data)->save()) {
            throw new Exception('Não foi possível atualizar a aula');
        }

        Session::flash('success', 'Aula atualizada!');

        return true;
    }

    public function deleteClass(Classes $class) {

        if($class->parent) {
            $class->parent->update(['has_reposition' => 0]);
        }

        if(!$class->delete()) {
            throw new Exception('Não foi possível excluir a aula');
        }

        Session::flash('success', 'Aula excluída!');
        return true;
    }

    public function remarkClass($data) {

        $class = $this->findClass($data['classes_id']);

        try {
            $new                     = $class->replicate();
            $new->date               = $data['date'];
            $new->time               = $data['time'];
            $new->instructor_id      = $data['instructor_id'];
            $new->main_instructor_id = $new->instructor_id;
            $new->type               = 'RP';
            $new->situation          = null;
            $new->comments           = null;
            $new->status             = 0;
            $new->class_reposition_id = $new->class_reposition_id ?? $class->id;
            $new->save();
        } catch (\Exception $e) {
            Session::flash('error', 'Não foi possível reagendar a aula. ('. $e->getMessage().')');
        }

        Session::flash('success', 'Aula reagendada com sucesso!');

        return true;

    }

    public function setAbsense($idClass, $data) {

        $class = $this->findClass($idClass);

        try {
            
    
            if($class->parent && (isset($data['situation']) && $data['situation'] == 'PP')) {
                $class->parent->update(['has_reposition' => 1]);
            }
            
            $data['status'] = 1;

            $class->fill($data)->update();
        } catch (\Throwable $th) {
            Session::flash('error', 'Não foi possível reagendar a aula. ('. $th->getMessage().')');
        }

        Session::flash('success', 'Aula alterada com sucesso!');

        return true;
    }

    public function setPresence($idClass, $data) {

        $class = $this->findClass($idClass);

        try {
            $data['status'] = 1;
            $data['situation'] = 'PP';
            $data['evolution_date'] = now();

            $class->fill($data)->update();

            if($class->parent) {
                $class->parent->update(['has_reposition' => 1]);
            }

        } catch (\Throwable $th) {
            Session::flash('error', 'Não foi marcar presença nessa aula. ('. $th->getMessage().')');
        }

        Session::flash('success', 'Presença marcada com sucesso!');

        return true;
    }

    public function resetClass($idClass) {
        $class = Classes::find($idClass);

        if($class->parent) {
            $class->parent->update(['has_reposition' => 0]);
        }

        return $class->update([
            'status' => 0,
            'situation' => null,
            'evolution' => null,
            'evolution_date' => null
        ]);
    }

    public function listClassesToRepositionByStudent($idStudent) {

            return Classes::with('student.user')
                    ->with('modality')
                    ->with('repositions.modality')
                    ->where('student_id', $idStudent)
                    ->where('situation', 'FJ')
                    ->where('type', 'AN')
                    ->where('has_reposition', 0)
                    ->whereNotIn('id', function($q) use ($idStudent) {
                        $q->select('class_reposition_id')
                        ->from('classes')
                        ->where('student_id', $idStudent)
                        ->whereNotNull('class_reposition_id')
                        ->where('status', 0)
                        ->whereNull('deleted_at');
                    })
                    ->get();                    
    }

    

    public function listClassesByModality(Registration $registration) {

        // dd($registration);
        return Classes::
                    with('instructor.user')
                    ->with('registration')
                    ->where('student_id',$registration->student_id)
                    ->where('modality_id', $registration->modality_id)
                    ->orderBy('date')
                    ->get();
    }

    public function listCountStatusClasses($idStudent, $idModality) {

        return Classes::
                selectRaw("COUNT(*) as total")
                ->selectRaw("SUM(CASE WHEN status = 1 AND situation = 'PP' THEN 1 ELSE 0 END) as presences")
                ->selectRaw("SUM(CASE WHEN status = 1 AND situation IN ('FF', 'FJ') THEN 1 ELSE 0 END) as absenses")
                ->selectRaw("SUM(CASE WHEN type = 'RP' THEN 1 ELSE 0 END) as repositions")
                ->where('student_id',$idStudent)
                ->where('modality_id', $idModality)
                ->first();

    }


    public function listToDataTable() {

        $classes = Classes::with('modality')
                    ->with('student.user')
                    ->with('instructor')
                    ->get();

        foreach($classes as $class) {

            // $delete = view('components.delete-modal', compact('class'))->render();
            $delete = '';

            $response[] = [
                'date' => '<a href="'.route('class.show', $class).'">'.$class->date->format('d/m/Y').'</a>' ,
                'time' => $class->time,
                'modality' => $class->modality->name,
                'type' => $class->typeDescription,
                'student' => $class->student->user->shortName ?? $class->studentName,
                'instructor' => $class->instructor->user->shortName,
                'status' => $class->statusDescription,
                'actions' => '
                            <a href="'.route('class.edit', $class).'">Editar</a>
                ' . $delete
            ];
        }

        return ['data' => $response];
    }


}