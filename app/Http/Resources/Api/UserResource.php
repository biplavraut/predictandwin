<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
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
            'id'    => encrypt($this->id),
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'rank' => 100,
            'points' => 200,
            'solved' => 50,
            'createdAt' => date_format($this->created_at, "F j, Y, g:i a")
        ];
    }
}
