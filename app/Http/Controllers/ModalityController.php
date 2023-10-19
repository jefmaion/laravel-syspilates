<?php

namespace App\Http\Controllers;

use App\Models\Modality;
use App\Http\Requests\StoreModalityRequest;
use App\Http\Requests\UpdateModalityRequest;
use App\Services\ModalityService;
use Illuminate\Http\Request;

class ModalityController extends Controller
{

    private $modalityService;

    public function __construct(ModalityService $modalityService)
    {
        $this->modalityService = $modalityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return response()->json($this->modalityService->listToDataTable());
        }

        return view('modality.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modality.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModalityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModalityRequest $request)
    {
        $data = $request->except('_token');

        try {
            $modality = $this->modalityService->createModality($data);
        } catch (\Exception $e) {
            return redirect()->route('modality.index')->withError($e->getMessage());
        }

        return redirect()->route('modality.show', $modality);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function show(Modality $modality)
    {
        return view('modality.show', compact('modality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function edit(Modality $modality)
    {
        return view('modality.edit', compact('modality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModalityRequest  $request
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModalityRequest $request, Modality $modality)
    {
        $data = $request->except(['_token', '_method']);

        try {
            $modality = $this->modalityService->updateModality($modality, $data);
        } catch (\Exception $e) {
            return redirect()->route('modality.show', $modality);
        }

        return redirect()->route('modality.show', $modality);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modality  $modality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modality $modality)
    {
        $this->modalityService->deleteModality($modality);
        return redirect()->route('modality.index');
    }
}
