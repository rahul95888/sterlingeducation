<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessCapabilityResource extends JsonResource
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
            'process_capability_uid' => $this->process_capability_uid,
            'process_capability_name' => $this->process_capability_name,
            'commodity' => new CommodityResource($this->whenLoaded('commodity')),
        ];
    }
}
