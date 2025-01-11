<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    // type attributes
    public function type_attribute()
    {
        return $this->hasMany(Type_attribute::class);
    }
}
