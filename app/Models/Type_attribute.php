<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_attribute extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    // relationship
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function expenditure_type()
    {
        return $this->belongsTo(Expenditure_type::class);
    }
}
