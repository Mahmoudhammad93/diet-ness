<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
