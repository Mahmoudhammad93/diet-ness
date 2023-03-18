<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'meal_id', 'component_id', 'user_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function meals(){
        return $this->belongsTo(PlanMeal::class, 'meal_id');
    }

    public function components(){
        return $this->belongsTo(MealComponents::class, 'component_id');
    }
}
