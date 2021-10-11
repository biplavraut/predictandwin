<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'image',
        'category_id', 'partner_id', 'answer',
        'daily', 'take_a_quiz', 'difficulty', 'point', 'premium_point',
        'order_item', 'excerpt', 'display', 'featured', 'start_at', 'end_at',
        'created_by', 'updated_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function answer()
    {
        return $this->belongsTo(Option::class, 'answer');
    }

    public function option()
    {
        return $this->hasMany(Option::class, 'quiz_id');
    }
}
