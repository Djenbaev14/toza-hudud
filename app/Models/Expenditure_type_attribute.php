<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure_type_attribute extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function expenditure()
    {
        return $this->belongsTo(Expenditure::class);
    }
    public function type_attribute()
    {
        return $this->belongsTo(Type_attribute::class);
    }
    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }
}
