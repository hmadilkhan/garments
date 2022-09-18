<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DesignController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Master/Designs/Index",[
            "designs" => Design::with("user:id,name")->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Master/Designs/Create");
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
            'code' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'size' => 'required',
        ]);
        try {
            $fileData = $this->uploads($request->image,'design/');
            $data = array_merge($validated,["image" => (!empty($fileData) ? $fileData["fileName"] : "")]);
            $request->user()->designs()->create($data);
            return redirect()->route("design.index");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(Design $design)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design)
    {
        return Inertia::render("Master/Designs/Edit",[
            "design" => $design,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Design $design)
    {
        return $request->code;
        $validated = $request->validate([
            'code' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'size' => 'required',
        ]);
        try {
            $fileData = $this->uploads($request->image,'design/');
            if ($request->file) {
                $data = array_merge($validated,["image" => (!empty($fileData) ? $fileData["fileName"] : "")]);
            }else{
                $data = $validated;
            }
            $design->update($data);
            return redirect()->route("design.index");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        //
    }
}
