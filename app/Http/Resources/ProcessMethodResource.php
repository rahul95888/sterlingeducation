<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessMethodResource extends JsonResource
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
            'process_method_uid' => $this->process_method_uid,
            'process_method_name' => $this->process_method_name,
            'commodity' => new CommodityResource($this->whenLoaded('commodity')),
        ];
    }
}
