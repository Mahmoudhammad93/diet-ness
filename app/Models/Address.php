<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function getAddressAttribute()
    {
        if (Lang() == "ar") {
            return $this->address_ar;
        }
        return $this->address_en;
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }
}
