<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'unique_user_id' => $this->unique_user_id,
            'mobile_number' => $this->mobile_number,
            'registered_at' => $this->registered_at ? $this->registered_at->format('d/m/Y') : null,
            'registered_from' => $this->registered_from,
            'name'=> $this->name,
            'user_type' => $this->user_type,
            'ho_location' => $this->ho_location,
            'job_works' => $this->job_works,
            'mandi_registration_details' => $this->mandi_registration_details,
            'branch_locations' => $this->branch_locations,
        ];
    }
}
