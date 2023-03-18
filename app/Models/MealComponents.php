<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealComponents extends Model
{
    use HasFactory;

    protected $table = 'meals_components';

    protected $fillable = ['component_id', 'plan_meal_id'];
}
