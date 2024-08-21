<?php

namespace App\Http\Controllers;

use App\Models\Visits;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\Visit\StoreRequest;
use App\Http\Requests\Visit\UpdateRequest;

class VisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visits = Visits::all();
        return Inertia::render('Visitas/Index',compact('visits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Visitas/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        Visits::create($data);
        return to_route('visitas.index');
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Visits $visits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visits $visits)
    {
        // dd($visits);
        return Inertia::render('Visitas/Edit',compact('visits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Visits $visits)
    {
        $data = $request->all();
        $visits->update($data);

        return to_route('visitas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visits $visits)
    {
        $visits->delete();
        return to_route('visitas.index');
    }
}
