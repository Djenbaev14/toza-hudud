<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Garage extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;
    protected $table = 'garages';
    public $sortable = ['name',
    'car_number',
    'created_at',
    'car'];
    // guarded
    protected $guarded = ['id'];
    // car realtionship
    public function car(){
        return $this->belongsTo(Car::class);
    }
    // driver relationship
    public function garage_driver(){
        return $this->hasOne(GarageDriver::class);
    }
    public function garage_expenditure_type(){
        return $this->hasMany(Garage_expenditure_type::class);
    }
    public function standard_expend(){
        return $this->hasMany(Standart_Expenditure::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
