<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'last_weight', 'goal_weight', 'sex', 'birthdate', 'user_id', 'goal_id'
    ];

    public function golaCategory(){
        return $this->belongsTo(GoalCategory::class, 'goal_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
