<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanMeal extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $hidden = [
        // 'name_ar',
        // 'name_en',
        // 'details_ar',
        // 'details_en',
        // 'meal_id',
        // 'category_id'
    ];

    // protected $appends = ['name','details'];

    // public function getNameAttribute()
    // {
    //     if (Lang() == "ar") {
    //         return $this->name_ar;
    //     }
    //     return $this->name_en;
    // }

    // public function getDetailsAttribute()
    // {
    //     if (Lang() == "ar") {
    //         return $this->details_ar;
    //     }
    //     return $this->details_en;
    // }

    public function getImageAttribute($image){
        return ($image)? asset('storage/meals/'.$image): asset('storage/meals/default.png');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediaable');
    }

}
