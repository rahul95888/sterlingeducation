<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PopResource extends JsonResource
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
            // 'id' => $this->id,
            'pop_uid' => $this->pop_uid,
            'title' => $this->title,
            // 'commodity_uid' => $this->commodity_uid,
            // 'section_uid' => $this->section_uid,
            'content' => $this->content ? str_ireplace(array("\r", "\n", '\r', '\n'), '', stripslashes($this->content)) : '',
            // 'image' => $this->image ? asset('assets/uploaded_images/pops/' . $this->image) : null,
            'audio' => $this->audio ? get_file_from_aws($this->audio) : null,
           
            'commodity' => new CommodityResource($this->whenLoaded('commodity')),
            // 'section' => new SectionResource($this->whenLoaded('section')),
            'created_at' => $this->created_at ? $this->created_at->format('d-F-Y') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('d-F-Y') : null,
        ];
    }
}
