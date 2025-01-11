<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class GarageDriver extends Model
{
    use HasFactory,SoftDeletes,Sortable;
    protected $guarded = ['id'];
    public $sortable = [
        'garage',
        'driver',
        'branch',
        'created_at',
    ];
    public function garage(){
        return $this->belongsTo(Garage::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function driver(){
        return $this->belongsTo(Driver::class);
    }
    
}
