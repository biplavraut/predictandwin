<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'image', 'excerpt', 'display', 'featured', 'start_at', 'end_at', 'created_by', 'updated_by'];
}
