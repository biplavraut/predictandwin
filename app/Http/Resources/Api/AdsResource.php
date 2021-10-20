<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
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
            'title'  => $this->title,
            'slug' => $this->slug,
            'display' => $this->display == 1,
            'featured' => $this->featured == 1,
            'image' => $this->image == 'no-image.png' ? asset('storage/' . $this->image) : asset('storage/images/ads/' . $this->slug . '/' . $this->image),
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'excerpt' => $this->excerpt,
            'created_at' => $this->created_at
        ];
    }
}
