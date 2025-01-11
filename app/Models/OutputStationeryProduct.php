<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputStationeryProduct extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function stationery(){
        return $this->belongsTo(Stationery::class);
    }
}
