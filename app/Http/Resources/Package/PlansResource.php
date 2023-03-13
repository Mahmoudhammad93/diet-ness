<?php

namespace App\Http\Resources\Package;

use Illuminate\Http\Resources\Json\JsonResource;

class PlansResource extends JsonResource
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
            'name' => $this->name,
            'old_price' => $this->old_price,
            'new_price' => $this->new_price,
            'details' => $this->details,
            'is_default' => (bool)$this->is_default,
            'meals' => MealsResource::collection($this->meals)
        ];
    }
}
