<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'city_uid' => $this->city_uid,
            'city_name' => $this->city_name,
            'city_code' => $this->city_code,
            'state_uid' => $this->state_uid,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'state' => new StateResource($this->whenLoaded('state')),
        ];
    }
}
