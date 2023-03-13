<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    
    public $guarded = [];
    
    protected $hidden = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
    ];

    protected $appends = ['name','description'];

    public function getNameAttribute()
    {
        if (Lang() == "ar") {
            return $this->name_ar;
        }
        return $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        if (Lang() == "ar") {
            return $this->description_ar;
        }
        return $this->description_en;
    }

    public function plans(){
        return $this->hasMany(Plan::class ,'package_id');
    }

    public function plan(){
        return $this->hasOne(Plan::class ,'package_id')->where('is_default',1);
    }
}
