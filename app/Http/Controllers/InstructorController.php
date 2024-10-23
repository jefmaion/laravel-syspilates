<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Models\Modality;
use App\Services\InstructorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InstructorController extends Controller
{
    private $instructorService;

    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }

    public function index(Request $request)
    {



        if($request->ajax()) {
            return response()->json($this->instructorService->listToDataTable());
        }

        return view('instructor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(User::all()->keyBy('id')->pluck('name', 'id'));
        return view('instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInstructorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstructorRequest $request)
    {
        $data = $request->except('_token');

        try {
            $instructor = $this->instructorService->createInstructor($data);
        } catch (\Exception $e) {
            return redirect()->route('instructor.index')->withError($e->getMessage());
        }

        return redirect()->route('instructor.show', $instructor);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $instructor = $this->instructorService->findInstructor($id);
        $modalities = Modality::whereNotIn('id', $instructor->modalities->pluck('id'))->get()->keyBy('id')->pluck('name', 'id');
        return view('instructor.show', compact('instructor', 'modalities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        return view('instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstructorRequest  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $data = $request->except(['_token', '_method']);

        try {
            $instructor = $this->instructorService->updateInstructor($instructor, $data);
        } catch (\Exception $e) {
            return redirect()->route('instructor.show', $instructor);
        }

        return redirect()->route('instructor.show', $instructor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $this->instructorService->deleteInstructor($instructor);
        return redirect()->route('instructor.index');
    }

    public function sendPassword(Instructor $instructor) {

        if(empty($instructor->user->email)) {
            Session::flash('error', 'Não existe email cadastrado para esse professor!');
            return redirect()->route('instructor.show', $instructor);
        }

        $this->instructorService->resendPassword($instructor);

        Session::flash('success', 'Email enviado!!');
        return redirect()->route('instructor.show', $instructor);
    }
}
