<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase_Spare extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function purchase__spare_product()
    {
        return $this->hasMany(Purchase_Spare_product::class);
    }
}
