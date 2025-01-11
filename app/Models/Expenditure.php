<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenditure extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    public function expenditure_type()
    {
        return $this->belongsTo(Expenditure_type::class);
    }
    public function expenditure_type_attribute()
    {
        return $this->hasMany(Expenditure_type_attribute::class);
    }
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function garage_expens()
    {
        return $this->hasOne(Garage_expenditure_type::class);
    }
}
