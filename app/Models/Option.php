<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'quiz_id', 'is_answer', 'order_item', 'created_by', 'updated_by'];
}
