<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dimension extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ["size"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
