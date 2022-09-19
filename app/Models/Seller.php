<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ["name","phone","address","bank","bank_name","account_no"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
