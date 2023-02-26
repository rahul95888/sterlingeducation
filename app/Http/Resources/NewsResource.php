<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'news_uid' => $this->news_uid,
            'title' => $this->title,
            'commodity_uid' => $this->commodity_uid,
            'content' => $this->content ? str_ireplace(array("\r", "\n", '\r', '\n'), '', stripslashes($this->content))  : '',
            'image' => $this->image ? get_file_from_aws($this->image) : null,
            'created_at' => $this->created_at ? $this->created_at->format('d-F-Y') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('d-F-Y') : null,
            'commodity' => new CommodityResource($this->commodity),
        ];
    }
}
