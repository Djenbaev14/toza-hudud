<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stationery extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=['id'];

    // unit 
    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }
}
