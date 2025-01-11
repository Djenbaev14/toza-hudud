<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase_Spare_product extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $guarded=['id'];
    public function purchase_spare()
    {
        return $this->belongsTo(Purchase_Spare::class, );
    }
        //product
    public function spare_part()
    {
        return $this->belongsTo(Spare_part::class,);
    }
    
}
