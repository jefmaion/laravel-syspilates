<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\Modality;
use App\Models\Registration;
use App\Models\Student;
use App\View\Components\Avatar as ComponentsAvatar;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;

class RegistrationService {

    public function find($id) {
        return Registration::with('classes.instructor.user')->with('modality')->find($id);
    }


    public function makeRegistration(Student $student, $data) {

        // dd($data);
        
        $data['end']        = $this->generateEndRegistrationDate($data);
        $data['class_week'] = json_encode($data['class']);

    

        if(!$registration = $student->registrations()->create($data)) {
            throw new Exception('Erro ao matricular aluno.');
        }

       foreach($data['class'] as $class) {
            $registration->weekdays()->create($class);
       }
    

        $this->generateClasses($registration, $data['class']);

        $status = 0;
        $payDate = null;

        if($data['duration'] > 0) {
            $date = $data['pay_date'];
            for($i = 1; $i <= $data['duration']; $i++) {

                $status = 0;
                $payDate = null;

                if($i == 1 && (isset($data['pay']) && $data['pay'] == 1)) {
                    $status = 1;
                    $payDate = now();
                }

             


                Transaction::create([
                    'value' => $data['value'],
                    'student_id' => $registration->student_id,
                    'registration_id' => $registration->id,
                    'payment_method_id' => $data['first_payment_method_id'],
                    'type' => 'R',
                    'category_id' => 6,
                    'date' => $date,
                    'status' => $status,
                    'pay_date' => $payDate,
                    'description' => $registration->student->user->shortName . ' ('. $registration->modality->nick. ' ' .($i).' de '.$data['duration'].')'
                ]);  
    
                $date = date('Y-m-d', strtotime($date . ' + 1 months'));
            }
        } else {
            foreach($registration->classes as $i => $class) {

                $status = 0;
                $payDate = null;

                if($i == 0 && (isset($data['pay']) && $data['pay'] == 1)) {
                    $status = 1;
                    $payDate = now();
                }

                Transaction::create([
                    'value' => $data['value'],
                    'student_id' => $registration->student_id,
                    'registration_id' => $registration->id,
                    'payment_method_id' => $data['first_payment_method_id'],
                    'type' => 'R',
                    'category_id' => 6,
                    'date' => $class->date,
                    'status' => $status,
                    'pay_date' => $payDate,
                    'description' => $registration->student->user->shortName  . ' ('. $registration->modality->nick. ' ' . ($i+1).' de '.$data['num_classes'].')'
                ]); 
            }
        }


        Session::flash('success', 'Modalidade matriculada com sucesso');
        return $registration;

    }

    public function updateRegistration(Registration $registration, $data) {

        $data['duration'] = $registration->duration;
        $data['num_classes'] = $registration->num_classes;

        $data['start'] = (!isset($data['start'])) ? $registration->start : $data['start'];

        $data['end']        = $this->generateEndRegistrationDate($data);
        $data['class_week'] = json_encode($data['class']);

        

        if(!$registration->fill($data)->save()) {
            throw new Exception('Erro ao editar matrícula');
        }

        
        foreach($data['class'] as $class) {
            $registration->weekdays()->create($class);
       }


        $this->generateClasses($registration, $data['class'], true);

        Session::flash('success', 'Modalidade matriculada com sucesso');
        return true;

    }

    public function removeRegistration(Registration $registration) {


        Classes::
            where('student_id', $registration->student_id)
            ->where('modality_id', $registration->modality_id)
            ->where('status', 0)->delete();


            // Validar
        // $registration->transactions()->whereNull('pay_date')->delete();
        $registration->update(['is_active' => 0]);

        if($registration->classes()->count() == 0) {
            $registration->delete();
        }
    }

    public function renewRegistration(Student $student, Registration $registration, $data) {
        $registration->update(['is_active' => 0]);
       

        if(!$registration = $this->makeRegistration($student, $data)) {
            throw new Exception('Erro ao renovar matrícula');
        }

        Session::flash('success', 'Modalidade renovada com sucesso');
        return $registration;
    }

    public function listClassGrade() {

        $data = Registration::with('student.user')->with('modality')->where('is_active', 1)->get();

        $grade = [];
        foreach($data as $item) {
            foreach($item->weekClass as $day) {
                $grade[$day->weekday][$day->time][] = [
                    'id' => $item->student->id,
                    'name' => $item->student->user->shortName . ' ('.$item->modality->nick.')'
                ];
            }
        }


        return $grade;

    }

    public function listToDataTable() {
        $registrations = Registration::
                            with('student.user')
                            ->with('modality')
                            ->where('is_active', 1)
                            ->get();

        $response = [];

        foreach($registrations as $registration) {

            $avatar = Blade::renderComponent(new ComponentsAvatar($registration->student->user, '25px'));

            $value = currency($registration->value);

            if(!user_can()) {
                $value = "-";
            }

            $response[] = [
                'name' => $avatar . '<a href="'.route('student.show', $registration->student).'">'.$registration->student->user->name.'</a>' ,
                'modality' => $registration->modality->name,
                'status' => '<span class="badge badge-pill bg-' . (($registration->daysToRenew <= 3) ? 'warning' : 'success') . '">
                                '.$registration->position.'
                            </span>',
                'plan' => $registration->planDescription,
                'start' => $registration->start->format('d/m/Y'),
                'end' => $registration->end->format('d/m/Y'),
                'value' => $value,
                'created_at' => $registration->created_at->format('d/m/Y H:i:s')
            ];
        }

        return ['data' => $response];
    }

    private function generateClasses(Registration $registration, $classes, $delete=false) {
        $cls = [];

        if($delete) {
            $registration->classes()->where('status', 0)->delete();
        }

        $allModalityClass = Classes::
                            where('modality_id', $registration->modality_id)
                            ->where('status', 0)
                            ->where('type', 'AN')
                            ->where('student_id', $registration->student_id)->get();


        $existsClass = [];
        foreach($allModalityClass as $cx) {
            $existsClass[$cx->date->format('Y-m-d')] = $cx;
        }



        foreach($classes as $item) {

            $startDate = (date('w', strtotime($registration->start)) == $item['weekday']) ? $registration->start :  $registration->start->next((int) $item['weekday']); // Get the first friday.
            $endDate   = $registration->end;

            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
                if(isset($existsClass[$date->format('Y-m-d')])) {
                    $classToUpdate = $existsClass[$date->format('Y-m-d')];
                    $classToUpdate->fill($item)->update();

                    unset($existsClass[$date->format('Y-m-d')]);
                } else {
                    $cls = [
                        'registration_id'         => $registration->id,
                        'student_id'              => $registration->student_id,
                        'modality_id'             => $registration->modality_id,
                        'instructor_id'           => $item['instructor_id'],
                        'main_instructor_id' => $item['instructor_id'],
                        'type'                    => 'AN',
                        'date'                    => $date->format('Y-m-d'),
                        'time'                    => $item['time'],
                        'status'                  => 0,
                  ];
                    Classes::create($cls);
                }
            }
        }

        /** Atualiza aulas de matriculas anteriores */
        // if(!empty($existsClass)) {
        //     foreach($classes as $item) {
        //         foreach($existsClass as $class) {
        //             $class->fill($item)->update();
        //         }
        //     }
        // }



        return true;
    }

    private function generateEndRegistrationDate($data) {

        $end  = date('Y-m-d', strtotime($data['start'] . ' +' . $data['duration'] . 'months'));

        if($data['duration'] == 0) {

            $end = date('Y-m-d', strtotime($data['start']));
            $weeks = array_keys($data['class']);
    
            $i = 0;
            while($i < $data['num_classes']) {
                $wd = date('w', strtotime($end));
                if(in_array($wd, $weeks)) {
                    $i++;
                }
                $end = date('Y-m-d', strtotime($end . '+1 days'));
            }
  
        }

        return $end;
    }


}