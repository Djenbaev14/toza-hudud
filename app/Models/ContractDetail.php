<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=['id'];

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
