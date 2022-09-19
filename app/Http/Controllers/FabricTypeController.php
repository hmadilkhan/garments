<?php

namespace App\Http\Controllers;

use App\Models\FabricType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FabricTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Master/FabricTypes/Index",[
            "fabricTypes" => FabricType::all(),
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fabric' => 'required',
            'type' => 'required',
            'color' => 'required',
        ]);
        try {
            FabricType::create($validated);
            return redirect()->route("fabric-type.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FabricType  $fabricType
     * @return \Illuminate\Http\Response
     */
    public function show(FabricType $fabricType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FabricType  $fabricType
     * @return \Illuminate\Http\Response
     */
    public function edit(FabricType $fabricType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FabricType  $fabricType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FabricType $fabricType)
    {
        $validated = $request->validate([
            'fabric' => 'required',
            'type' => 'required',
            'color' => 'required',
        ]);
        try {
            $fabricType->update($validated);
            return redirect()->route("fabric-type.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FabricType  $fabricType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FabricType $fabricType)
    {
        try {
            $fabricType->delete();
            return redirect()->route("fabric-type.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
