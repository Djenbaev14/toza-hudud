<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver_license extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'certificate_category_id' => 'array', // JSON maydonni array sifatida olish
    ];
    public function certificate_category(){
        return $this->belongsTo(Certificate_category::class);
    }
}
