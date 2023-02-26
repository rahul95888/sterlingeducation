<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BidResource extends JsonResource
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
            'bid_uid' => $this->bid_uid,
            'trade_uid' => $this->trade_uid,
            'unique_user_id' => $this->unique_user_id,
            'user_type' => $this->user_type,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'comment' => $this->comment,
            'created_date' => $this->created_at ? $this->created_at->format('d/m/Y') : null,
            'updated_date' => $this->updated_at ? $this->updated_at->format('d/m/Y') : null,
            'status_by' => $this->statusby,
            'trade' => new TradeResource($this->whenLoaded('trade')->load('variety','commodity')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
