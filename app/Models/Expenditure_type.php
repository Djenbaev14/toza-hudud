<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure_type extends Model
{
    use HasFactory;
    // guarded
    protected $guarded = ['id'];

    // relationship
    public function expenditure()
    {
        return $this->hasMany(Expenditure::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function type_attribute()
    {
        return $this->hasMany(Type_attribute::class);
    }
    public function garage_expens()
    {
        return $this->hasMany(Garage_expenditure_type::class);
    }

}
