<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ImageCrop;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdsResource;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        if (\Gate::allows('canView')) {
            $data = Ads::latest()->paginate(10);
            return AdsResource::collection($data);
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
        if (\Gate::allows('canAddUser')) {
            $this->validate($request, [
                'title' => 'required|string|max:191'
            ]);
            $slug = Str::slug($request->title);
            if ($request->image) {
                $image = new ImageCrop('ads', $slug, $request->image);
                $finalImage = $image->resizeCropImage(500, 500);
                $request->merge(['image' => $finalImage]);
            } else {
                $request->merge(['image' => "no-image.png"]);
            }
            $request->merge(['slug' => $slug, 'created_by' => $request->user()->id, 'updated_by' => $request->user()->id]);
            $store = Ads::create($request->all());
            if ($store) {
                return ['result' => 'success', 'message' => 'Ads added successfully! '];
            } else {
                return ['result' => 'error', 'message' => 'Something went wrong!'];
            }
        } else {
            return ['result' => 'error', 'message' => 'Unauthorized! Access Denied'];
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
            $data = Ads::findOrFail(decrypt($id));
            return new AdsResource($data);
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
        if (\Gate::allows('canEditUser')) {
            $user = Ads::findOrFail(decrypt($id));
            $this->validate($request, [
                'title' => 'required|string|max:191'
            ]);
            $slug = Str::slug($request->title);
            if ($request->image) {
                $image = new ImageCrop('ads', $slug, $request->image);
                $finalImage = $image->resizeCropImage(500, 500);
                $request->merge(['image' => $finalImage, 'updated_by' => $request->user()->id]);
            } else {
                $request->merge(['image' => "no-image.png", 'updated_by' => $request->user()->id]);
            }
            $user->update($request->all());
            return ['result' => 'success', 'message' => 'Ads updated successfully!'];
        } else {
            return ['result' => 'error', 'message' => 'Unauthorized! Access Denied'];
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
        if (\Gate::allows('canDeleteUser')) {
            $data = Ads::findOrFail(decrypt($id));
            $data->delete();
            return ['result' => 'success', 'message' => 'Ads Deleted Successfully'];
        } else {
            return ['result' => 'error', 'message' => 'Unauthorized! Access Denied'];
        }
    }
}
