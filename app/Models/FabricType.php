<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FabricType extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ["fabric","type","color"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
