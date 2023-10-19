<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRemarkClassRequest;
use App\Models\Classes;
use App\Models\Exercice;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\Registration;
use App\Models\RegistrationClass;
use App\Models\Student;
use App\Services\CalendarService;
use App\Services\ClassService;
use App\Services\InstructorService;
use App\Services\ModalityService;
use App\Services\StudentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Builder\Class_;

class CalendarController extends Controller
{

    protected $calendarService;
    protected $classService;
    protected $instructorService;
    protected $studentService;
    protected $modalityService;

    public function __construct(
        CalendarService $calendarService, 
        ClassService $classService, 
        InstructorService $instructorService, 
        StudentService $studentService, 
        ModalityService $modalityService
    )
    {
        $this->calendarService   = $calendarService;
        $this->classService      = $classService;
        $this->instructorService = $instructorService;
        $this->studentService    = $studentService;
        $this->modalityService   = $modalityService;
    }


    public function index(Request $request) {
        $instructors = $this->instructorService->listToSelectBox();
        $students    = $this->studentService->listToSelectBox();
        $modalities  = $this->modalityService->listToSelectBox();

        return view('calendar.index', compact('instructors', 'modalities', 'students'));
    }

    public function list(Request $request) {
        $calendar = $this->calendarService->listScheduledClass($request->get('start'), $request->get('end'));
        return response()->json($calendar);
    }

    public function event(Request $request) {

        $class = $this->classService->findClass($request->get('id'));

        $repositions = [];
        $pendencies = [];
        if($class->type !== 'AE') {
            $repositions = $this->classService->listClassesToRepositionByStudent($class->student->id);
            $pendencies = $this->calendarService->listPendencies($class);
        }

        return view('calendar.show', compact('class', 'repositions', 'pendencies'));
    }

    public function edit(Request $request, $id) {
        $class = Classes::find($id);
        $exercices = Exercice::get()->pluck('name', 'id');
    
        $view = $request->input('action');

        if($view == 'presence') {
            
            $data = [
                'title'  => 'Marcar Presença',
                'status' => 1
            ];
        }

        if($view == 'absense') {
            $data = [
                'title'  => 'Marcar Falta',
                'status' => 1
            ];
        }

        if($view == 'cancel') {
            $data = [
                'title'  => 'Cancelar Aula',
                'status' => 1
            ];
        }


        return view('calendar.'.$view, compact('class', 'data', 'exercices'))->render();
    }

    public function showExperimental() {
        $instructors = $this->instructorService->listToSelectBox();
        $students    = $this->studentService->listToSelectBox();
        $modalities  = $this->modalityService->listToSelectBox();

        return view('calendar.experimental', compact('instructors', 'modalities', 'students'));
    }

    public function remark(StoreRemarkClassRequest $request) {

        try {
            $data = $request->except('_token');
            $this->classService->remarkClass($data);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }

        return response()->json(['success' => true, 'message' => Session::get('success')]);

    }

    public function showRemark() {
        $instructors = Instructor::with('user')->get()->pluck('user.name', 'id');
        $students = $this->calendarService->listStudentsClassNotRemarked();

        $not = Classes::whereNotNull('class_reposition_id')->where('status', 0)->get()->pluck('class_reposition_id');

        $classes = Classes::with('student.user')
                    ->with('modality')
                    ->whereNotIn('id', $not)
                    ->where('situation', 'FJ')
                    ->where('type', 'AN')
                    ->where('has_reposition', 0)
                    ->get()
                    ->pluck('combo', 'id');

        return view('calendar.remark', compact('students', 'instructors', 'classes'))->render();
    }

    public function listNotRemark(Request $request) {
        $id = $request->get('student_id');


        $data = $this->calendarService->listClassesToRemarkByStudent($id);

        $response = [];
        foreach($data as $d) {
            $response[$d->id] = $d->date->format('d/m/Y') .' '.$d->time . ' '.$d->modality->nick;
        }

        return response()->json($response);
    }


    public function destroy($id) {
        
        try {
            $class = Classes::find($id);
            $this->classService->deleteClass($class);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }

        return response()->json(['success' => true, 'message' => Session::get('success')]);
    }
}
