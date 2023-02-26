<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'district_uid' => $this->district_uid,
            'district_name' => $this->district_name,
            'state_uid' => $this->state_uid,
            'state' => new StateResource($this->whenLoaded('state')),
        ];
    }
}
