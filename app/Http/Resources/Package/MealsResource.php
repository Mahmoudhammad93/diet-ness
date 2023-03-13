<?php

namespace App\Http\Resources\Package;

use Illuminate\Http\Resources\Json\JsonResource;

class MealsResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'details'=>$this->details,
            'quantity'=>$this->quantity,
            'max'=>$this->max,
            'min'=>$this->min,
            'image'=>($this->image()->exists())?$this->image->url:"",
        ];
    }
}
