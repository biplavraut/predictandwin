<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'image' => $this->image == 'no-image.png' ? asset('storage/' . $this->image) : asset('storage/images/quiz/' . $this->slug . '/' . $this->image),
            'options' => $this->option,
            'difficulty' => $this->difficulty,
            'point' => $this->point,
            'premium_point' => $this->premium_point,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'createdAt' => $this->created_at
        ];
    }
}
