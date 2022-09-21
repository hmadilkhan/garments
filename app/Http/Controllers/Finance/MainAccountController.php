<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\AccountType;
use App\Models\Finance\MainAccount;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Inertia::render("Finance/MainAccount/Index",[
            "accountTypes" => AccountType::all(),
            "accounts" => MainAccount::all(),
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
            'account_type_id' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);
        try {
            $data = array_merge($validated,["user_id" => auth()->user()->id]);
            MainAccount::create($data);
            return redirect()->route("main-account.index");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finance\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function show(MainAccount $mainAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finance\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(MainAccount $mainAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finance\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainAccount $mainAccount)
    {
        $validated = $request->validate([
            'account_type_id' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);
        try {
            $mainAccount->update($validated);
            return redirect()->route("main-account.index");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finance\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainAccount $mainAccount)
    {
        try {
            $mainAccount->delete();
            return redirect()->route("main-account.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
