<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionMeal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function meal()
    {
        return $this->belongsTo(PlanMeal::class, 'plan_meal_id');
    }
}
