<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityResource extends JsonResource
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
            'commodity_uid' => $this->commodity_uid,
            'name' => $this->name,
            'image' => $this->image ? get_file_from_aws($this->image) : null,
            'varieties' => VarietyResource::collection($this->whenLoaded('varieties')),
        ];
    }
}
