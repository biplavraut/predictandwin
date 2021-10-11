<?php

namespace App\Http\Resources\Admin;

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
            'business_name' => $this->business_name,
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type'  => $this->type ?? 'promoter',
            'enabled' => $this->enabled == 1,
            'image' => $this->image == 'no-image.png' ? asset('storage/' . $this->image) : asset('storage/images/partner/' . $this->slug . '/' . $this->image),
            'address' => $this->address,
            'excerpt' => $this->excerpt,
            'created_at' => $this->created_at
        ];
    }
}
