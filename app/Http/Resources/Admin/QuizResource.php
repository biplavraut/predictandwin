<?php

namespace App\Http\Resources\Admin;

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
            'title' => $this->title,
            'slug'  => $this->slug,
            'options' => $this->option()->select('title as text', 'id as value')->get(),
            'answer' => $this->option()->where('is_answer', 1)->pluck('id')->first(),
            'answers' => $this->option()->where('is_answer', 1)->pluck('title')->first(),
            'category_id' => $this->category_id,
            'category' => $this->category()->pluck('title')->first(),
            'partner_id' => $this->partner_id,
            'partner' => $this->partner()->pluck('name')->first(),
            'difficulty'  => $this->type ?? 'easy',
            'daily' => $this->daily == 1,
            'take_a_quiz' => $this->take_a_quiz == 1,
            'display' => $this->display == 1,
            'featured' => $this->featured == 1,
            'point' => $this->point,
            'premium_point' => $this->premium_point,
            'image' => $this->image == 'no-image.png' ? asset('storage/' . $this->image) : asset('storage/images/quiz/' . $this->slug . '/' . $this->image),
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'excerpt' => $this->excerpt,
            'created_at' => $this->created_at
        ];
    }
}
