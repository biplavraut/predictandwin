<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function index()
    {
        # code...
        $data = Quiz::where('display', 1)->latest()->paginate(10);
        return QuizResource::collection($data);
    }

    public function categoryQuiz(Request $request)
    {
        # code...
        $data = Quiz::where([['display', 1], ['category_id', decrypt($request->categoryId)]])->latest()->paginate(10);
        return QuizResource::collection($data);
    }

    // public function takeQuiz()
    // {
    // }
}
