<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'notification_uid' => $this->notification_uid,
            'unique_user_id' => $this->unique_user_id,
            'message' => $this->message,
            'seen' => $this->seen,
            'date' => $this->created_at ? $this->created_at->format('d/m/Y') : null,
        ];
    }
}
