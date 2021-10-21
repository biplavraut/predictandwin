<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use App\Helper\ImageCrop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Admin\PartnerResource;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (\Gate::allows('canView')) {
            $data = Partner::latest()->paginate(10);
            return PartnerResource::collection($data);
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
                'name' => 'required|string|max:191',
                'email' => 'required|string|email|max:191|unique:admins',
                'business_name' => 'required|string'
            ]);
            $slug = Str::slug($request->name);
            if ($request->image) {
                $image = new ImageCrop('partner', $slug, $request->image);
                $finalImage = $image->resizeCropImage(500, 500);
                $request->merge(['image' => $finalImage]);
            } else {
                $request->merge(['image' => "no-image.png"]);
            }
            $request->merge(['slug' => $slug, 'created_by' => $request->user()->id, 'updated_by' => $request->user()->id]);
            $store = Partner::create($request->all());
            if ($store) {
                return ['result' => 'success', 'message' => 'Partner added successfully! '];
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
            $data = Partner::findOrFail(decrypt($id));
            return new PartnerResource($data);
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
        //
        if (\Gate::allows('canEditUser')) {
            $user = Partner::findOrFail(decrypt($id));
            $this->validate($request, [
                'name' => 'required|string|max:191',
                'email' => 'required|string|email|max:191|unique:admins,email,' . $user->id,
                'business_name' => 'required|string'
            ]);
            $slug = Str::slug($request->name);
            if ($request->image) {
                $image = new ImageCrop('partner', $slug, $request->image);
                $finalImage = $image->resizeCropImage(500, 500);
                $request->merge(['image' => $finalImage, 'updated_by' => $request->user()->id]);
            } else {
                $request->merge(['image' => "no-image.png", 'updated_by' => $request->user()->id]);
            }
            $user->update($request->all());
            return ['result' => 'success', 'message' => 'Partner updated successfully!'];
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
        //
        if (Gate::allows('canDeleteUser')) {
            $data = Partner::findOrFail(decrypt($id));
            $data->delete();
            return ['result' => 'success', 'message' => 'Partner Deleted Successfully'];
        } else {
            return ['result' => 'error', 'message' => 'Unauthorized! Access Denied'];
        }
    }

    public function selectPartner()
    {
        $data = Partner::select('id as value', 'business_name as text', 'slug')->where('enabled', 1)->get();
        return response()->json(['data' => $data]);
    }
}
