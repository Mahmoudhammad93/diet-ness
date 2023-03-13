<?php

namespace App\Http\Resources\Subscription;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'plan' => $this->plan->name,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'total' => number_format($this->total, 3),
            'payment_status' => trans('admin.' . $this->payment_status),
            'status' => trans('admin.' . $this->status),
            'meals' => MealsResource::collection($this->meals)
        ];
    }
}
