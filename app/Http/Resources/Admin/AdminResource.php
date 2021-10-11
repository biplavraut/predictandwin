<?php


namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;


class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $slug = Str::slug($this->name);
        return [
            'id'    => encrypt($this->id),
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type'  => $this->type ?? 'admin',
            'enabled' => $this->enabled == 1,
            'image' => $this->image == 'no-image.png' ? asset('storage/' . $this->image) : asset('storage/images/admin/' . $slug . '/' . $this->image),
            'github' => $this->github,
            'linkedin' => $this->linkedin,
            'address' => $this->address,
            'bio' => $this->bio,
            'created_at' => $this->created_at
        ];
    }
}
