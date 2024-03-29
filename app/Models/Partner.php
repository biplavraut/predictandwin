<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $fillable = ['business_name', 'slug', 'name','email', 'phone', 'password', 'image','enabled','type','address','excerpt','created_by', 'updated_by'];

}
