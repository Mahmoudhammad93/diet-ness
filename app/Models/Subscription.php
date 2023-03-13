<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['day_left'];

    public function getDayLeftAttribute()
    {
        $endAt = Carbon::parse($this->end_at);
        $now = Carbon::parse(date("Y-m-d"));

        $diff_in_days = $now->diffInDays($endAt);
        if($endAt < $now){
            return 0;
        }
        return $diff_in_days;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function meals()
    {
        return $this->hasMany(SubscriptionMeal::class, 'subscription_id');
    }

    public function address()
    {
        return $this->hasOne(SubscriptionAddress::class, 'subscription_id');
    }
}
