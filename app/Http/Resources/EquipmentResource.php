<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
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
            'equipment_uid' => $this->equipment_uid,
            'equipment_name' => $this->equipment_name,
            'description' => $this->description ? str_ireplace(array("\r", "\n", '\r', '\n'), '', stripslashes($this->description)) : '',
        ];
    }
}
