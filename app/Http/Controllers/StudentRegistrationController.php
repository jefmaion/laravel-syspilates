<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRegistrationRequest;
use App\Http\Requests\UpdateStudentRegistrationRequest;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\PaymentMethod;
use App\Models\Registration;
use App\Models\Student;
use App\Services\ClassService;
use App\Services\RegistrationService;
use App\Services\StudentService;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Http\Request;

class StudentRegistrationController extends Controller
{
    
    private $registrationService;
    private $studentService;
    private $classService;

    public function __construct(RegistrationService $registrationService, StudentService $studentService, ClassService $classService)
    {
        $this->registrationService = $registrationService;
        $this->studentService = $studentService;
        $this->classService = $classService;
    }


    public function create(Student $student) {
        $modalities = Modality::get()->keyBy('id')->pluck('name', 'id');
        $instructors = Instructor::with('user')->get()->keyBy('id')->pluck('user.name', 'id');
        $payments = PaymentMethod::get()->keyBy('id')->pluck('name', 'id');
        $registration = new Registration();
        $grade  =$this->registrationService->listClassGrade();

        return view('student.registration.create', compact('registration', 'student', 'modalities', 'instructors', 'grade', 'payments'));
    }


    public function store($idStudent, StoreStudentRegistrationRequest $request){
        $data = $request->except(['_token']);

        
        $student = $this->studentService->find($idStudent);

        $this->registrationService->makeRegistration($student, $data);


        return  redirect()->route('student.show', $student);

        
    }

    public function show(Student $student, Registration $registration) {
        $registration = $this->registrationService->find($registration->id);
        $classes      = $this->classService->listClassesByModality($registration);
        $resume = $this->classService->listCountStatusClasses($registration->student_id, $registration->modality_id);
        return view('student.registration.show', compact('student', 'registration', 'classes', 'resume'));
    }

    public function destroy(Student $student, Registration $registration) {

        $this->registrationService->removeRegistration($registration);

        return  redirect()->route('student.show', $student);

    }

    public function edit(Student $student, Registration $registration) {

        $modalities = Modality::get()->keyBy('id')->pluck('name', 'id');
        $instructors = Instructor::with('user')->get()->keyBy('id')->pluck('user.name', 'id');
        $payments = PaymentMethod::get()->keyBy('id')->pluck('name', 'id');

        $grade  =$this->registrationService->listClassGrade();
        

        return view('student.registration.edit', compact('registration', 'student', 'modalities', 'instructors', 'grade', 'payments'));

    }

    public function update(Student $student, Registration $registration, UpdateStudentRegistrationRequest $request) {
        $data = $request->except(['_method', '_token']);


        $this->registrationService->updateRegistration($registration, $data);

        return $this->show($student, $registration);
    }

    public function renew(Student $student, Registration $registration) {
        $modalities = Modality::get()->keyBy('id')->pluck('name', 'id');
        $instructors = Instructor::with('user')->get()->keyBy('id')->pluck('user.name', 'id');
        $payments = PaymentMethod::get()->keyBy('id')->pluck('name', 'id');

        $grade  =$this->registrationService->listClassGrade();

        $id = $registration->id;
        unset($registration->id);
        $registration->start = $registration->end;
        

        return view('student.registration.renew', compact('registration', 'student', 'modalities', 'payments', 'instructors', 'grade', 'id'));
    }

    public function renewStore(Student $student, Registration $registration, StoreStudentRegistrationRequest $request) {

        $data = $request->except('_token');

      

        $newRegistration = $this->registrationService->renewRegistration($student, $registration, $data);

        return  redirect()->route('student.registration.show', [$student, $newRegistration]);

    }
}
