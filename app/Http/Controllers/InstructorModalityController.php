<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructorModalityRequest;
use App\Models\Instructor;
use App\Models\Modality;
use App\Services\InstructorService;
use App\View\Components\ModalDelete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class InstructorModalityController extends Controller
{
    
    protected $instructorService;

    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }

    public function index(Instructor $instructor, Request $request) {
        $modalities = Modality::whereNotIn('id', $instructor->modalities->pluck('id'))->get()->keyBy('id')->pluck('name', 'id');
        return view('instructor.modality.index', compact('instructor', 'modalities'));
    }

    public function store(Instructor $instructor, StoreInstructorModalityRequest $request) {
        $data = $request->except(['_token']);
        $this->instructorService->attachModality($instructor, $data);

        return redirect()->route('instructor.modality.index', $instructor);
    }

    public function destroy(Instructor $instructor, $id) {
        $this->instructorService->detachModality($instructor, $id);

        return redirect()->route('instructor.modality.index', $instructor);
    }

}
