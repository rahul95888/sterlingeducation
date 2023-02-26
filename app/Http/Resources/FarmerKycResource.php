<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerKycResource extends JsonResource
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
            'aadhar_number' => $this->aadhar_number,
            'aadhar_document' => $this->aadhar_document ? get_file_from_aws($this->aadhar_document) : null,
            'account_number' => $this->account_number,
            'account_holder_name' => $this->account_holder_name,
            'ifsc_code' => $this->ifsc_code,
            'bank_name' => $this->bank_name,
            'branch_name' => $this->branch_name,
            'bank_document' => $this->bank_document ? get_file_from_aws($this->bank_document) : null,
            'address_document_type' => $this->address_document_type,
            'address_document_id_number' => $this->address_document_id_number,
            'address_document' => $this->address_document ? get_file_from_aws($this->address_document) : null,
            'kyc_status' => $this->kyc_status,
            'education' => new EducationResource($this->whenLoaded('education')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'state' => new StateResource($this->whenLoaded('state')),
            'city' => new CityResource($this->whenLoaded('city')),
            'district' => new DistrictResource($this->whenLoaded('district')),
            'sub_district' => new SubDistrictResource($this->whenLoaded('subDistrict')),
            'village' => new VillageResource($this->whenLoaded('village')),
            'pincode' => new PinCodeResource($this->whenLoaded('pincode')),
        ];
    }
}
