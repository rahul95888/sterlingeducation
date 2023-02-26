<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VillageResource extends JsonResource
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
            'village_uid' => $this->village_uid,
            'village_name' => $this->village_name,
            'sub_district_uid' => $this->sub_district_uid,
            'subDistrict' => new SubDistrictResource($this->whenLoaded('subDistrict')),
        ];
    }
}
