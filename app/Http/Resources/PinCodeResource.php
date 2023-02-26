<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PinCodeResource extends JsonResource
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
            'pincode_uid' => $this->pincode_uid,
            'pincode' => $this->pincode,
            'city_uid' => $this->city_uid,
            'city' => new CityResource($this->whenLoaded('city')),
        ];
    }
}
