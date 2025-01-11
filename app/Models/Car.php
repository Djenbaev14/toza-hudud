<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;
    // guarded
    protected $guarded = ['id'];
    // garages
    public function garages(){
        return $this->hasMany(Garage::class);
    }
}
