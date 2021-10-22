<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'activity', 'user_id', 'quiz_id', 'answer', 'point', 'reward', 'type', 'remarks'];
}
