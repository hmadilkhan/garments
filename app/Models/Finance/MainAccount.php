<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainAccount extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ["user_id","account_type_id","code","title","status_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(AccountType::class);
    }
}
