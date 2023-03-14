<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calory extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'total', 'day', 'burned', 'user_id'
    ];

    public function getBurnedAttribute($attr){
        return ($attr == 1)? $this->burned = true : $this->burned = false;
    }
}
