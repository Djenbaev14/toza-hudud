<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage_expenditure_type extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function expenditure(){
        return $this->belongsTo(expenditure::class);
    }
}
