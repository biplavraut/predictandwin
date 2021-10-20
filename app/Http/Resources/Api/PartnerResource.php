<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
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
            'businessName '  => $this->business_name,
            'slug' => $this->slug,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->image == 'no-image.png' ? asset('storage/' . $this->image) : asset('storage/images/partner/' . $this->slug . '/' . $this->image),
            'excerpt' => $this->excerpt,
            'createdAt' => $this->created_at
        ];
    }
}
