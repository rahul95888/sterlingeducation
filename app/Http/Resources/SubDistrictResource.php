<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubDistrictResource extends JsonResource
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
            'sub_district_uid' => $this->sub_district_uid,
            'sub_district_name' => $this->sub_district_name,
            'district_uid' => $this->district_uid,
            'district' => new DistrictResource($this->whenLoaded('district')),
        ];
    }
}
