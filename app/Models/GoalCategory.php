<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalCategory extends Model
{
    use HasFactory;

    protected $table = 'goalcategories';

    protected $fillable = [
        'image', 'ar_name', 'en_name', 'status'
    ];

    public function getImageAttribute($image){
        if($image){
            return asset('storage/goal_categories/'.$image);
        }else{
            return asset('storage/goal_categories/default.png');
        }
    }
}
