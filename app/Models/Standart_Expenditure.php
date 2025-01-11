<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standart_Expenditure extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function garage(){
        return $this->Belong(Garage::class);
    }
    public function expenditure_type(){
        return $this->belongsTo(Expenditure_type::class);
    }
}
