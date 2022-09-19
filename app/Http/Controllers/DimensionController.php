<?php

namespace App\Http\Controllers;

use App\Models\Dimension;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DimensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Master/Dimensions/Index",[
            "dimensions" => Dimension::all(),
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
            'size' => 'required',
        ]);
        try {
           Dimension::create(["size" => $request->size]);
           return redirect()->route("dimension.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dimension  $dimension
     * @return \Illuminate\Http\Response
     */
    public function show(Dimension $dimension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dimension  $dimension
     * @return \Illuminate\Http\Response
     */
    public function edit(Dimension $dimension)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dimension  $dimension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dimension $dimension)
    {
        $validated = $request->validate([
            'size' => 'required',
        ]);
        try {
           $dimension->update(["size" => $request->size]);
           return redirect()->route("dimension.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dimension  $dimension
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dimension $dimension)
    {
        try {
            $dimension->delete();
            return redirect()->route("dimension.index");
         } catch (\Throwable $th) {
             //throw $th;
         }
    }
}
