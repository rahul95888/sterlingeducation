<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketingResource extends JsonResource
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
            'marketing_uid' => $this->marketing_uid,
            'banner_title' => $this->banner_title,
            'banner_image' => $this->banner_image ? get_file_from_aws($this->banner_image) : null,
            'banner_description' => $this->banner_description ? str_ireplace(array("\r", "\n", '\r', '\n'), '', stripslashes($this->banner_description)) : '',
            'banner_url' => $this->banner_url,
        ];
    }
}
