<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\QuizResource;
use App\Models\Quiz;
use App\Models\UserActivityLog;
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

    public function answer(Request $request)
    {
        $user = $request->user();
        $user->update(['played' => $user->played + 1]);
        $quiz = Quiz::findOrFail(decrypt($request->quizId));
        if ($quiz) {
            $answer = $quiz->option()->where([['is_answer', 1], ['quiz_id', $quiz->id]])->pluck('id')->first();
            if ($answer == $request->optionId) {
                $point = $user->type == 'premium' ? $quiz->premium_point : $quiz->point;
                UserActivityLog::create([
                    'title' => $user->name,
                    'activity' => 'Correct Answer',
                    'user_id' => $user->id,
                    'quiz_id' => $quiz->id,
                    'answer' => 1,
                    'point' => $point,
                    'reward' => 'earned',
                    'type' => 'quiz',
                    'remarks' => 'Earned: ' . $point . ', Added to user point.'
                ]);
                $user->update(['point' => $user->point + $point, 'solved' => $user->solved + 1]);
                return ['result' => 'success', 'message' => 'Answered!', 'answer' => true];
            } else {
                UserActivityLog::create([
                    'title' => $user->name,
                    'activity' => 'Wrong Answer',
                    'user_id' => $user->id,
                    'quiz_id' => $quiz->id,
                    'answer' => 0,
                    'point' => 0,
                    'reward' => 'earned',
                    'type' => 'quiz',
                    'remarks' => 'No point added to user point.'
                ]);
                return ['result' => 'success', 'message' => 'Answered!', 'answer' => false];
            }
        } else {
            return ['result' => 'error', 'message' => 'Quiz not found!'];
        }
    }
}
