<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Ledger;
use App\Models\Finance\SubAccount;
use App\Models\Finance\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Finance/Voucher/Index", [
            "vouchers" => Voucher::with("fromaccount:id,title","toaccount:id,title")->get(),
            "subaccounts" => SubAccount::with("mainaccount:id,title")->get(),
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
            "from_account" =>  "required",
            "to_account" =>   "required",
            "amount" =>   "required",
            "narration" =>  "required",
        ]);

        DB::beginTransaction();
        try {
            Voucher::create($request->only(["from_account","to_account","amount","narration"]));
            Ledger::create([
                "sub_account_id" => $request->to_account,
                "amount" =>  $request->amount,
                "narration" =>  $request->narration,
                "type" =>  "CR",
            ]);
            Ledger::create([
                "sub_account_id" => $request->from_account,
                "amount" =>  $request->amount,
                "narration" =>  $request->narration,
                "type" =>  "DR",
            ]);
            DB::commit();
            return redirect()->route("voucher.index");
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
