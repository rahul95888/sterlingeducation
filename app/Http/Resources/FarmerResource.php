<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerResource extends JsonResource
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
            'user_type' => $this->user_type,
            'mobile_number' => $this->mobile_number,
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth ? $this->date_of_birth->format('d/m/Y') : null,
            'gender' => $this->gender,
            'education_uid' => $this->education_uid,
            'email' => $this->email,
            'address' => $this->address,
            'country_uid' => $this->country_uid,
            'state_uid' => $this->state_uid,
            'city_uid' => $this->city_uid,
            'district_uid' => $this->district_uid,
            'sub_district_uid' => $this->sub_district_uid,
            'village_uid' => $this->village_uid,
            'pincode_uid' => $this->pincode_uid, 
            'aadhar_number' => $this->aadhar_number,
            'aadhar_document' => $this->aadhar_document ? get_file_from_aws($this->aadhar_document) : null,
            'account_number' => $this->account_number,
            'account_holder_name' => $this->account_holder_name,
            'ifsc_code' => $this->ifsc_code,
            'ho_location'=> $this->ho_location,
            'job_works'=> $this->job_works,
            'mandi_registration_details'=> $this->mandi_registration_details,
            'branch_locations'=> $this->branch_locations,
            // 'process_method_uid'=> $this->process_method_uid,
            // 'process_capability_uid' => $this->process_capability_uid,
            'bank_name' => $this->bank_name,
            'branch_name' => $this->branch_name,
            'bank_document' => $this->bank_document ? get_file_from_aws($this->bank_document) : null,
            'address_document_type' => $this->address_document_type,
            'address_document_id_number' => $this->address_document_id_number,
            'address_document' => $this->address_document ? get_file_from_aws($this->address_document) : null,
            'profile_image' => $this->profile_image ? get_file_from_aws($this->profile_image) : null,
            'kyc_status' => $this->kyc_status,
            'education' => new EducationResource($this->whenLoaded('education')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'state' => new StateResource($this->whenLoaded('state')),
            'city' => new CityResource($this->whenLoaded('city')),
            'district' => new DistrictResource($this->whenLoaded('district')),
            'sub_district' => new SubDistrictResource($this->whenLoaded('subDistrict')),
            'village' => new VillageResource($this->whenLoaded('village')),
            'pincode' => new PinCodeResource($this->whenLoaded('pincode')),
            'user_crop_details' => FarmerCropDetailResource::collection($this->whenLoaded('userCropDetails'))
        ];
    }
}
