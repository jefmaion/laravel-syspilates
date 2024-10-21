<?php

namespace App\Services;

use App\Mail\InstructorWelcomeMail;
use App\Models\Instructor;
use App\Models\User;
use App\View\Components\Avatar as ComponentsAvatar;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class InstructorService {

    public function findInstructor($id) {
        return Instructor::with('user')->with('classes.student.user')->with('classes.modality')->find($id);
    }

    public function createInstructor($data) {

        $password = Str::random(8);

        $data['user']['password'] = bcrypt($password);


        try {
            $user = User::create($data['user']);
            $instructor = (new Instructor())->fill($data['instructor']);
            $instructor->user()->associate($user)->save();

            $user->assignRole('Instrutor');
            $user->tenants()->sync([session('tenant_id')]);

            // Mail::to($teacher->email)->send(new TeacherWelcomeMail($teacher, $password));

            Mail::to($user->email)->send(new InstructorWelcomeMail($user, $password));


            Avatar::create($user->shortName)
                ->setFontFamily('Laravolt')
                ->setDimension(128, 128)
                ->setBackground('#001122')
                ->save(public_path('/avatar/' . $user->id . '.png', 100));

        } catch (\Exception $e) {

            $message = $e->errorInfo[2] ?? $e->getMessage();

            Session::flash('error', 'Não foi possível cadastrar o professor. ('. $message.')');
            return false;
        }

        Session::flash('success', 'Professor cadastrado com sucesso!!  (<a class="text-white" href="'.route('instructor.create').'">Adicionar Outro</a>)');

        return $instructor;
    }

    public function updateInstructor(Instructor $instructor, $data) {

        try {
            $instructor->user->fill($data['user'])->save();
            $instructor->fill($data['instructor'])->save();
        } catch (\Exception $e) {
            $message = ($e->errorInfo) ? $e->errorInfo[2] : $e->getMessage();
            Session::flash('error', 'Não foi possível atualizar o professor. ('. $message.')');
            return false;
        }

        Session::flash('success', 'Dados atualizados com sucesso!!');
        return $instructor;
    }

    public function deleteInstructor(Instructor $instructor) {
        $user = $instructor->user;
        $instructor->delete();
        $user->delete();

        if(file_exists(public_path('/avatar/' .$user->id.'.png' ))) {
            unlink(public_path('/avatar/' .$user->id.'.png' ));
        }

        Session::flash('success', 'Registro excluído com sucesso!!');
        return true;
    }

    public function attachModality(Instructor $instructor, $data) {
        return $instructor->modalities()->attach($instructor->id, $data);
    }

    public function detachModality(Instructor $instructor, $id) {
        return $instructor->modalities()->detach($id);
    }

    public function listToSelectBox() {
        return Instructor::with('user')->get()->pluck('user.name', 'id');
    }

    public function listToDataTable() {
        $instructors = Instructor::with('user')->get();

        $response = [];

        foreach($instructors as $instructor) {

            $avatar = Blade::renderComponent(new ComponentsAvatar($instructor->user, '25px'));

            $response[] = [
                'name' => $avatar . '<a href="'.route('instructor.show', $instructor).'">'.$instructor->user->name.'</a>' ,
                'phone_wpp' => $instructor->user->phone_wpp,
                'email' => $instructor->user->email,
                'created_at' => $instructor->created_at->format('d/m/Y H:i:s')
            ];
        }

        return ['data' => $response];
    }

}
