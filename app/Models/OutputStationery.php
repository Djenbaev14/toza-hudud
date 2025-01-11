<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputStationery extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function employee(){
        return $this->belongsTo(User::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function output_stationery_product(){
        return $this->hasMany(OutputStationeryProduct::class);
    }

}
