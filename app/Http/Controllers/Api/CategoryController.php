<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        # code...
        $category = Category::where('display', 1)->latest()->paginate(10);
        return CategoryResource::collection($category);
    }
}
