<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressesResource extends JsonResource
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
            'city' => $this->area->city->name,
            'area' => $this->area->name,
            'title' => $this->title,
            'street' => $this->street,
            'floor' => $this->floor,
            'apartment_no' => $this->apartment_no,
            'is_default' => (bool)$this->is_default,
        ];
    }
}
