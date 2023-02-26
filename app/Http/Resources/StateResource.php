<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
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
            'state_uid' => $this->state_uid,
            'state_name' => $this->state_name,
            'state_code' => $this->state_code,
            'country_uid' => $this->country_uid,
            'country' => new CountryResource($this->whenLoaded('country')),
        ];
    }
}
