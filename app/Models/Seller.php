<?php

namespace App\Models;

use App\Models\Finance\SubAccount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ["name","phone","address","bank","bank_name","account_no","sub_account_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subaccount()
    {
        return $this->belongsTo(SubAccount::class,"sub_account_id","id");
    }
}
