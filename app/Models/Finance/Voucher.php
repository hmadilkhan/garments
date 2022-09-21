<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function fromaccount()
    {
        return $this->belongsTo(SubAccount::class,"from_account","id");
    }
    public function toaccount()
    {
        return $this->belongsTo(SubAccount::class,"to_account","id");
    }
}
