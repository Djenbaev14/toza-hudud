<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase_stationer_product extends Model
{
    
    use HasFactory,SoftDeletes;
    
    protected $guarded=['id'];
    public function purchase_stationery()
    {
        return $this->belongsTo(Purchase_stationer::class, );
    }
        //product
    public function stationery()
    {
        return $this->belongsTo(Stationery::class,);
    }
}
