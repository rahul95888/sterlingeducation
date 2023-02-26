<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FpoCropDetailResource extends JsonResource
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
            'user_crop_detail_uid' => $this->user_crop_detail_uid,
            'commodity_uid' => $this->commodity_uid,
            'variety_uid' => $this->variety_uid,
            'sowling_date' => $this->sowling_date ? $this->sowling_date->format('d/m/Y') : null,
            'acreage' => $this->acreage,
            'farm_location' => $this->farm_location,
            'primary_processing_method' => $this->primary_processing_method,
            'process_capability' => $this->process_capability,
            'process_method' => $this->process_method,
            'commodity' => new CommodityResource($this->whenLoaded('commodity')),
            'variety' => new VarietyResource($this->whenLoaded('variety')),
            'farm_factor'=> new FarmFactorResource($this->whenLoaded('farm_factor')),
            'process_method' => new ProcessMethodResource($this->whenLoaded('process_method')),
            'process_capability' => new ProcessCapabilityResource($this->whenLoaded('process_capability'))
        ];
    }
}
