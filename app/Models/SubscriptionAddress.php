<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionAddress extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

}
