<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentClassRequest;
use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Registration;
use App\Models\Student;
use App\Services\ClassService;
use App\Services\InstructorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentClassController extends Controller
{
    
    private $classService;
    private $instructorService;

    public function __construct(ClassService $classService, InstructorService $instructorService) {
        $this->classService = $classService;
        $this->instructorService = $instructorService;
    }

    public function create(Student $student, Registration $registration) {
        $instructors = $this->instructorService->listToSelectBox();
        $class      = new Classes();
        return view('student.class.create', compact('class', 'student', 'registration', 'instructors'));
    }

    public function store(Student $student, Registration $registration, StoreStudentClassRequest $request) {

        $data = $request->except(['_method', '_token']);

        try {
            $this->classService->storeClass($registration, $data);
        } catch (\Throwable $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('student.registration.show', [$student, $registration]);

    }

    public function edit(Student $student, Registration $registration, Classes $class) {
        $instructors = $this->instructorService->listToSelectBox();
        return view('student.class.edit', compact('class', 'student', 'registration', 'instructors'));
    }

    public function update(Student $student, Registration $registration, Classes $class, Request $request) {

        $data = $request->except(['_method', '_token']);

        try {
            $this->classService->updateClass($class, $data);
        } catch (\Throwable $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('student.registration.show', [$student, $registration]);

    }

    public function destroy(Student $student, Registration $registration, Classes $class) {


        try {
            $this->classService->deleteClass($class);
        } catch (\Throwable $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('student.registration.show', [$student, $registration]);
    }

}
