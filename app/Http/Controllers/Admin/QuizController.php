<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ImageCrop;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\QuizResource;
use App\Models\Option;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (\Gate::allows('canView')) {
            $data = Quiz::latest()->paginate(10);
            return QuizResource::collection($data);
        } else {
            return ['result' => 'error', 'message' => 'Unauthorized! Access Denied'];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required|string|max:191',
        ]);
        if (count($request->options) <= 0) {
            return ['result' => 'error', 'message' => 'Options Not available!'];
        }
        $options = $request->options;
        $answer = $request->answer;
        $slug = Str::slug($request->title);
        if ($request->image) {
            $image = new ImageCrop('quiz', $slug, $request->image);
            $finalImage = $image->resizeCropImage(500, 500);
            $request->merge(['slug' => $slug, 'image' => $finalImage, 'created_by' => auth('admin')->user()->id, 'updated_by' => auth('admin')->user()->id]);
        } else {
            $request->merge(['slug' => $slug, 'image' => "no-image.png", 'created_by' => auth('admin')->user()->id, 'updated_by' => auth('admin')->user()->id]);
        }
        $store = Quiz::create($request->except(['options', 'answer']));
        if ($store) {
            $this->addOpton($store->id, $options, $request->answer);
            return ['result' => 'success', 'message' => 'Quiz added successfully! '];
        } else {
            return ['result' => 'error', 'message' => 'Something went wrong!'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (\Gate::allows('canEditUser')) {
            $data = Quiz::findOrFail(decrypt($id));
            return new QuizResource($data);
        } else {
            return ['result' => 'error', 'message' => 'Unauthorized! Access Denied'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required|string|max:191',
        ]);
        $data = Quiz::where('id', decrypt($id))->firstOrFail();
        $options = $request->options;
        $answer = $request->answer;
        $slug = Str::slug($request->title);
        if ($request->image) {
            $image = new ImageCrop('quiz', $slug, $request->image);
            $finalImage = $image->resizeCropImage(500, 500);
            $request->merge(['slug' => $slug, 'image' => $finalImage, 'updated_by' => auth('admin')->user()->id]);
            $update = $data->update($request->except(['options', 'answer']));
        } else {
            $request->merge(['updated_by' => auth('admin')->user()->id]);
            $update = $data->update($request->except(['image', 'options', 'answer']));
        }
        if ($update) {
            $this->addOpton($data->id, $options, $request->answer);
            return ['result' => 'success', 'message' => 'Quiz updated successfully! '];
        } else {
            return ['result' => 'error', 'message' => 'Something went wrong!'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        $data = Quiz::where('id', $id)->firstOrFail();
        return $data->delete();
    }

    public function addOpton($quiz_id, $options, $answer)
    {
        for ($i = 0; $i < count($options); $i++) {
            if (is_numeric($options[$i]['value'])) {
                $is_answer = ($answer == $options[$i]['value']) ? 1 : 0;
                Option::where('id', (int)$options[$i]['value'])->update(['is_answer' => $is_answer]);
            } else {
                $is_answer = ($answer == $options[$i]['value']) ? 1 : 0;
                Option::create(['title' => $options[$i]['text'], 'quiz_id' => $quiz_id, 'is_answer' => $is_answer]);
            }
        }
    }
}
