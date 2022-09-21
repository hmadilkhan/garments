<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class SubAccount extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ["user_id","main_account_id","code","title","status_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mainaccount()
    {
        return $this->belongsTo(MainAccount::class,"main_account_id","id");
    }

    public function ledger()
    {
        return  $this->hasMany(Ledger::class);
    }

    public function scopeBalance()
    {
        return  DB::select("Select a.id,a.code,a.title,b.code as maincode,b.title as mainaccounttitle,ifnull((Select SUM(amount) from ledgers where sub_account_id = a.id and type = 'CR'),0) - ifnull((Select SUM(amount) from ledgers where sub_account_id = a.id and type = 'DR'),0) as balance from sub_accounts a INNER JOIN main_accounts b on  a.main_account_id = b.id");
    }

    public function debit()
    {
        return  $this->hasMany(Ledger::class)->where("type","DR")->groupBy("sub_account_id")->select("id","sub_account_id",DB::raw("SUM(amount) as balance"))->first();
    }

}
