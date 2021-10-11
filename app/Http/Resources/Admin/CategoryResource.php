<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'image' => $this->image == 'no-image.png' ? asset('storage/' . $this->image) : asset('storage/images/category/' . $this->slug . '/' . $this->image),
            'excerpt' => $this->excerpt,
            'created_at' => $this->created_at
        ];
    }
}
