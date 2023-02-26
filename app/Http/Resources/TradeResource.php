<?php

namespace App\Http\Resources;

use App\Models\Commodity;
use Illuminate\Http\Resources\Json\JsonResource;

class TradeResource extends JsonResource
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
            'trade_uid' => $this->trade_uid,
            'commodity_uid' => $this->commodity_uid,
            'variety_uid' => $this->variety_uid,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'valid_from' => $this->valid_from ? $this->valid_from->format('d/m/Y') : null,
            'valid_to' => $this->valid_to ? $this->valid_to->format('d/m/Y') : null,
            'address' => $this->address,
            'taluka' => $this->taluka,
            'state_uid' => $this->state_uid,
            
            'city_uid' => $this->city_uid,
            'pincode_uid' => $this->pincode_uid,
            'country_uid' => $this->country_uid,
            'file' => $this->file ? get_file_from_aws($this->file) : null,
            'commodity' => new CommodityResource($this->whenLoaded('commodity')),
            'variety' => new VarietyResource($this->whenLoaded('variety')),
            'state' => new StateResource($this->whenLoaded('state')),
            'city' => new CityResource($this->whenLoaded('city')),
            'pincode' => new PinCodeResource($this->whenLoaded('pincode')),
            'country' => new CountryResource($this->whenLoaded('country')),
        ];
    }
}
