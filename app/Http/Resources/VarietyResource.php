<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VarietyResource extends JsonResource
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
            'variety_uid' => $this->variety_uid,
            'variety_name' => $this->variety_name,
            'from_price' => $this->from_price,
            'to_price' => $this->to_price,
        ];
    }
}
