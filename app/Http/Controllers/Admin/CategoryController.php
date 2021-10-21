<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ImageCrop;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
            $category = Category::latest()->paginate(10);
            return CategoryResource::collection($category);
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
        $slug = Str::slug($request->title);
        if ($request->image) {
            $image = new ImageCrop('category', $slug, $request->image);
            $finalImage = $image->resizeCropImage(500, 500);
            $request->merge(['slug' => $slug, 'image' => $finalImage, 'created_by' => auth('admin')->user()->id, 'updated_by' => auth('admin')->user()->id]);
        } else {
            $request->merge(['slug' => $slug, 'image' => "no-image.png", 'created_by' => auth('admin')->user()->id, 'updated_by' => auth('admin')->user()->id]);
        }
        $store = Category::create($request->all());
        if ($store) {
            return ['result' => 'success', 'message' => 'Category added successfully! '];
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
            $category = Category::findOrFail(decrypt($id));
            return new CategoryResource($category);
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
        $this->validate($request, [
            'title' => 'required|string|max:191',
        ]);
        $category = Category::where('id', decrypt($id))->firstOrFail();
        $slug = Str::slug($request->title);
        if ($request->image) {
            $image = new ImageCrop('category', $slug, $request->image);
            $finalImage = $image->resizeCropImage(500, 500);
            $request->merge(['slug' => $slug, 'image' => $finalImage, 'updated_by' => auth('admin')->user()->id]);
            $update = $category->update($request->all());
        } else {
            $request->merge(['updated_by' => auth('admin')->user()->id]);
            $update = $category->update($request->except(['image']));
        }
        if ($update) {
            return ['result' => 'success', 'message' => 'Category updated successfully! '];
        } else {
            return ['result' => 'error', 'message' => 'Something went wrong!'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $category = Category::where('slug', $slug)->firstOrFail();
        return $category->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $title
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        //
        $category = Category::where('title', 'like', '%' . $title . '%')->get();
        return $category;
    }

    public function selectCategory()
    {
        $data = Category::select('id as value', 'title as text', 'slug')->where('display', 1)->get();
        return response()->json(['data' => $data]);
    }
}
