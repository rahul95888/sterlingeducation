<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessorCropDetailResource extends JsonResource
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
            'daily_plant_capabality' => $this->daily_plant_capabality,
            'weekly_plant_capabality' => $this->weekly_plant_capabality,
            'monthly_plant_capabality' => $this->monthly_plant_capabality,
            'number_of_farmers_connected' => $this->number_of_farmers_connected,
            'acreage' => $this->acreage,
            'process_capability_uid' => $this->process_capability_uid,
            'state_uid' => $this->state_uid,
            'district_uid' => $this->district_uid,
            'sub_district_uid' => $this->sub_district_uid,
            'village_uid' => $this->village_uid,
            'process_method_uid' => $this->process_method_uid ,
            'job_works' => $this->job_works,
            'commodity' => new CommodityResource($this->whenLoaded('commodity')),
            'variety' => new VarietyResource($this->whenLoaded('variety')),
            'state' => new StateResource($this->whenLoaded('state')),
            'district' => new DistrictResource($this->whenLoaded('district')),
            'sub_district' => new SubDistrictResource($this->whenLoaded('subDistrict')),
            'village' => new VillageResource($this->whenLoaded('village')),
            'farm_factor'=> new FarmFactorResource($this->whenLoaded('farm_factor')),
            'process_method' => new ProcessMethodResource($this->whenLoaded('process_method')),
            'process_capability' => new ProcessCapabilityResource($this->whenLoaded('process_capability'))
        ];
    }
}
