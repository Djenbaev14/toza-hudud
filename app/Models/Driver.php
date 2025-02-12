<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;
    // guarded
    protected $guarded = ['id'];
    // sortable
    public $sortable = ['full_name', 'phone', 'created_at'];

    // garages
    public function garage_driver(){
        return $this->hasMany(GarageDriver::class);
    }
    
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function driver_license(){
        return $this->hasOne(Driver_license::class);
    }
    public function certificate_category(){
        return $this->hasMany(Certificate_category::class);
    }
}
