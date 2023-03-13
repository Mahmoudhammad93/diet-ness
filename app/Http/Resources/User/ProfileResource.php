<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'first_name' => $this->details->first_name,
            'last_name' => $this->details->last_name,
            'full_name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'device_type' => $this->fcm_token->device_type,
            'fcm_token' => $this->fcm_token->token,
            'gender' => $this->details->gender,
            'birth_date' => $this->details->birth_date,
        ];
    }
}
