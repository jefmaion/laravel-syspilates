<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbsenseClassRequest;
use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\StoreExperimentalClassRequest;
use App\Http\Requests\StorePresenceClassRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Models\Student;
use App\Services\ClassService;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassesController extends Controller
{

    protected $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      
        if(request()->ajax()) {
            return response()->json($this->classService->listToDataTable());
        }

        return view('classes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassesRequest $request)
    {
        $data = $request->except(['_token']);
        $data['status'] = 0;

        $studentService = new StudentService();

        $student = $studentService->createStudent([
            'student' => [],
            'user' => [
                'name' => $data['name'],
                'phone_wpp' => $data['phone_wpp']
            ]
        ]);

        return $student->classes()->create($data);

        return Classes::create($data);
    }

    public function storeExperimental(StoreExperimentalClassRequest $request) {
        


        try {

            $data = $request->except(['_token']);
            $this->classService->storeExperimentalClass($data);

        }  catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);

        }
    
        return response()->json(['success' => true, 'message' => Session::get('success')]);

        // return Classes::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$class = $this->classService->findClass($id)) {
            return redirect()->route('class.index')->with('info', 'Aula não encontrada');
        }

        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassesRequest  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassesRequest $request, $id)
    {
        $class = Classes::find($id);
        $data  = $request->except(['_token', '_method']);

        if(isset($data['situation']) && $data['situation'] == 'PP') {
            $data['evolution_date'] = now();
        }

        if($class->parent && (isset($data['situation']) && $data['situation'] == 'PP')) {
            $class->parent->update(['has_reposition' => 1]);
        }
        
        return $class->fill($data)->update();
        
    }

    public function absense(StoreAbsenseClassRequest $request, $id) {

        try {

            $data  = $request->except(['_token', '_method']);
            $this->classService->setAbsense($id, $data);

        }  catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);

        }
    
        return response()->json(['success' => true, 'message' => Session::get('success')]);

    }

    public function presence(StorePresenceClassRequest $request, $id) {
        
        try {

            $data  = $request->except(['_token', '_method']);
            $this->classService->setPresence($id, $data);

        }  catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);

        }
    
        return response()->json(['success' => true, 'message' => Session::get('success')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        try {
            $class = Classes::find($id);
            $this->classService->deleteClass($class);
        } catch (\Exception $e) {
            return redirect()->route('class.index');
        }

        return redirect()->route('class.index');
    }


    public function reset(Request $request) {
        $this->classService->resetClass($request->get('class_id'));
        return redirect()->route('calendar.index');
    }
}
