<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\MainAccount;
use App\Models\Finance\SubAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SubAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return SubAccount::balance();
        // return SubAccount::with("mainaccount:id,title,code","credit","debit")->get();
                // ->whereHas("ledger",function($query){
                //     $query->where("type","CR")->select(DB::raw("SUM(amount) as credit"));
                // })
                // ->whereHas("ledger",function($query){
                //     $query->where("type","DR")->select(DB::raw("SUM(amount) as debit"));
                // })
                // ->leftJoin("ledgers as a","sub_accounts.id","=","a.sub_account_id")
                // ->where("a.type","CR")
                // ->select("sub_accounts.*",DB::raw("SUM(a.amount) as balance"))
                // ->groupBy("a.sub_account_id")

        return Inertia::render("Finance/SubAccount/Index",[
            "subAccounts" => SubAccount::balance(),//SubAccount::with("mainaccount:id,title,code")->get(),
            "mainAccounts" => MainAccount::all(),
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
            'main_account_id' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);
        try {
            $data = array_merge($validated,["user_id" => auth()->user()->id]);
            SubAccount::create($data);
            return redirect()->route("sub-account.index");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finance\SubAccount  $subAccount
     * @return \Illuminate\Http\Response
     */
    public function show(SubAccount $subAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finance\SubAccount  $subAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(SubAccount $subAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finance\SubAccount  $subAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubAccount $subAccount)
    {
        $validated = $request->validate([
            'main_account_id' => 'required',
            'code' => 'required',
            'title' => 'required',
        ]);
        try {
            $subAccount->update($validated);
            return redirect()->route("sub-account.index");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finance\SubAccount  $subAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubAccount $subAccount)
    {
        try {
            $subAccount->delete();
            return redirect()->route("sub-account.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
