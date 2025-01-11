<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Spare_part extends Model
{
    use HasFactory,SoftDeletes,Sortable;
    protected $guarded=['id'];
    // sortable
    public $sortable = ['name',
    'price',
    'created_at'];

    // unit 
    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }
    public function getCountProductAttribute(){
        return countSparePart($this->id);
    }
}
