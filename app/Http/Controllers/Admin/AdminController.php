<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ImageCrop;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
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
            $admins = Admin::latest()->paginate(10);
            return AdminResource::collection($admins);
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
                'password' => 'required|string|min:6'
            ]);
            $slug = Str::slug($request->name);
            if ($request->image) {
                $image = new ImageCrop('admin', $slug, $request->image);
                $finalImage = $image->resizeCropImage(500, 500);
                $request->merge(['image' => $finalImage]);
            } else {
                $request->merge(['image' => "no-image.png"]);
            }
            $request->merge(['password' => Hash::make($request->password), 'created_by' => $request->user()->id, 'updated_by' => $request->user()->id]);
            $store = Admin::create($request->all());
            if ($store) {
                return ['result' => 'success', 'message' => 'Admin user added successfully! '];
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
            $user = Admin::findOrFail(decrypt($id));
            return new AdminResource($user);
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
            $user = Admin::findOrFail(decrypt($id));
            $this->validate($request, [
                'name' => 'required|string|max:191',
                'email' => 'required|string|email|max:191|unique:admins,email,' . $user->id,
                'password' => 'sometimes|min:6'
            ]);
            $slug = Str::slug($request->name);
            if ($request->image) {
                $image = new ImageCrop('admin', $slug, $request->image);
                $finalImage = $image->resizeCropImage(500, 500);
                $request->merge(['image' => $finalImage]);
            } else {
                $request->merge(['image' => "no-image.png"]);
            }
            $user->update($request->all());
            return ['result' => 'success', 'message' => 'Admin user info updated successfully!'];
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
            $user = Admin::findOrFail(decrypt($id));
            $user->delete();
            return ['result' => 'success', 'message' => 'Admin user Deleted Successfully'];
        } else {
            return ['result' => 'error', 'message' => 'Unauthorized! Access Denied'];
        }
    }

    //update profile by logged in User
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->merge(['updated_by' => $request->user()->id]);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:admins,email,' . $user->id,
        ]);
        $slug = Str::slug($request->name);
        if ($request->image) {
            $image = new ImageCrop('admin', $slug, $request->image);
            $finalImage = $image->resizeCropImage(500, 500);
            $request->merge(['image' => $finalImage]);
        } else {
            $request->merge(['image' => "no-image.png"]);
        }
        $user->update($request->all());
        return ['result' => 'success', 'message' => 'Profile info updated'];
    }

    //update password by logged in User
    public function updatePassword(Request $request)
    {
        $user =  Auth::user();
        $this->validate($request, [
            'old_password' => 'required|min:8',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8'
        ]);
        if ($request->password == $request->confirm_password) {
            $pass = Admin::select('password')->where('id', '=', $user->id)->first();
            if (password_verify($request->old_password, $pass->password)) {
                if (!empty($request->password)) {
                    $request->merge(['password' => Hash::make($request['password'])]);
                }
                Admin::where('id', '=', $request->id)->update(['password' => $request->password]);
                return ['result' => 'success', 'message' => 'New Password updated.'];
            } else {
                return ['result' => 'error', "message" => 'Old Password doesnot match.'];
            }
        } else {
            return ['result' => 'error', "message" => 'New Password doesnot match.'];
        }
    }
}
