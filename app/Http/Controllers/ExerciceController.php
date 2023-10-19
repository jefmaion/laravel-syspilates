<?php

namespace App\Http\Controllers;

use App\Models\Exercice;
use App\Http\Requests\StoreExerciceRequest;
use App\Http\Requests\UpdateExerciceRequest;
use App\Services\ExerciceService;
use Illuminate\Http\Request;

class ExerciceController extends Controller
{

    private $exerciceService;

    public function __construct(ExerciceService $exerciceService)
    {
        $this->exerciceService = $exerciceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return response()->json($this->exerciceService->listToDataTable());
        }

        return view('exercice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exercice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExerciceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExerciceRequest $request)
    {
        $data = $request->except('_token');

        try {
            $exercice = $this->exerciceService->createExercice($data);
        } catch (\Exception $e) {
            return redirect()->route('exercice.index')->withError($e->getMessage());
        }

        return redirect()->route('exercice.show', $exercice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function show(Exercice $exercice)
    {
        return view('exercice.show', compact('exercice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercice $exercice)
    {
        return view('exercice.edit', compact('exercice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExerciceRequest  $request
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExerciceRequest $request, Exercice $exercice)
    {
        $data = $request->except(['_token', '_method']);

        try {
            $exercice = $this->exerciceService->updateExercice($exercice, $data);
        } catch (\Exception $e) {
            return redirect()->route('exercice.show', $exercice);
        }

        return redirect()->route('exercice.show', $exercice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercice $exercice)
    {
        $this->exerciceService->deleteExercice($exercice);
        return redirect()->route('exercice.index');
    }
}
