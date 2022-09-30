<?php

namespace App\Http\Controllers;

use App\Models\Finance\MainAccount;
use App\Models\Finance\SubAccount;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Master/Sellers/Index", [
            "sellers" => Seller::with("subaccount")->paginate(10),
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
            'name' => 'required',
            'phone' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $mainAccount = MainAccount::where("title", "Payables")->first();
            $subAccount = SubAccount::where("main_account_id", $mainAccount->id)->count();
            $subAccountResult = SubAccount::create([
                "user_id" => auth()->user()->id,
                "main_account_id" => $mainAccount->id,
                "code" => $mainAccount->code + ($subAccount + 1),
                "title" => $request->name,
            ]);
            $data = array_merge($request->except(["id"]),["sub_account_id" => $subAccountResult->id]);
            Seller::create($data );
            DB::commit();
            return redirect()->route("seller.index");
        } catch (\Throwable $th) {
            DB::rollback();
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);
        try {
            $seller->update($request->except(["id"]));
            SubAccount::where("id",$request->subaccountId)->update(["title" => $request->name]);
            return redirect()->route("seller.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        try {
            $seller->delete();
            return redirect()->route("seller.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
