<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
        //product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
