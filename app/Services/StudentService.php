<?php

namespace App\Services;

use App\Models\Student;
use App\Models\User;
use App\View\Components\Avatar as ComponentsAvatar;
use Exception;
use Illuminate\Support\Facades\Blade;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Session;

class StudentService {


    public function find($id) {
        return Student::
                    with('registrations.modality')
                    ->with('classes.instructor.user')
                    ->with('classes.modality')
                    ->with('classes.registration')
                    ->with('installments.category')
                    ->with('installments.method')
                    ->findOrFail($id);
    }

    public function createStudent($data) {

        $data['user']['password'] = bcrypt('123123123');

        try {
            $user = User::create($data['user']);
            $student = (new Student())->fill($data['student']);
            $student->user()->associate($user)->save();

            $avatarName = time().'.png';

            Avatar::create(strtoupper($user->shortName))
                ->setFontFamily('Laravolt')
                ->setDimension(128, 128)
                // ->setBackground('#001122')
                ->save(public_path('/avatar/' . $avatarName, 100));

            $user->update(['image' => $avatarName]);

        } catch (\Exception $e) {
            $message = (isset($e->errorInfo)) ? $e->errorInfo[2] : $e->getMessage();
            throw new Exception('Não foi possível cadastrar o aluno. ('. $message.')');
        }

        Session::flash('success', 'Aluno cadastrado com sucesso!! (<a class="text-white" href="'.route('student.create').'">Adicionar Outro</a>)');

        return $student;
    }

    public function updateStudent(Student $student, $data) {

        try {
            $student->user->fill($data['user'])->save();
            $student->fill($data['student'])->save();
        } catch (\Exception $e) {
            $message = ($e->errorInfo) ? $e->errorInfo[2] : $e->getMessage();
            Session::flash('error', 'Não foi possível atualizar o aluno. ('. $message.')');
            return false;
        }

        Session::flash('success', 'Dados atualizados com sucesso!!');
        return $student;
    }

    public function deleteStudent(Student $student) {
        $user = $student->user;
        $student->delete();
        $user->delete();

        if(file_exists(public_path('/avatar/' .$user->id.'.png' ))) {
            unlink(public_path('/avatar/' .$user->id.'.png' ));
        }

        Session::flash('success', 'Registro excluído com sucesso!!');
        return true;
    }

    public function listToSelectBox() {
        return Student::with('user')->get()->sortBy('user.name')->pluck('user.shortName', 'id');
    }

    public function listToDataTable() {
        $students = Student::with('user')->with('registrations')->orderBy('created_at', 'desc')->get();

        
        $response = [];

        foreach($students as $student) {

            $avatar = Blade::renderComponent(new ComponentsAvatar($student->user, '25px'));

            $badgeColor = ($student->activeRegistrations()->exists()) ? 'success' : 'light border';
            $cake = ($student->user->isBirthday) ? ' <i class="fa fa-birthday-cake text-warning" aria-hidden="true"></i>' : '';

            $response[] = [
                'name' => $avatar . '<a href="'.route('student.show', $student).'">'.$student->user->name.$cake.'</a>' ,
                'phone_wpp' => $student->user->phone_wpp,
                'email' => $student->user->email,
                'status' => '<h6><span class="badge badge-pill badge-'.$badgeColor.'">'.$student->status.'</span></h6>',
                'created_at' => $student->created_at->format('d/m/Y H:i:s')
            ];
        }

        return ['data' => $response];
    }

}