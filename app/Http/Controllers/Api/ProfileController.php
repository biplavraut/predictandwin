<?php

namespace App\Http\Controllers\Api;

use App\Helper\ImageCrop;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = [
            'user' => new UserResource($request->user())
        ];
        return response()->json([
            'result' => 'success',
            'message' => 'User Profile',
            'data' => $data
        ]);
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
        $user = $request->user();
        $request->merge(['updated_by' => $request->user()->id]);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
        ]);
        if ($request->image) {
            $image = new ImageCrop('admin', $user->slug, $request->image);
            $finalImage = $image->resizeCropImage(500, 500);
            $request->merge(['image' => $finalImage]);
        } else {
            $request->merge(['image' => "no-image.png"]);
        }
        $user->update($request->all());
        return ['result' => 'success', 'message' => 'Profile info updated'];
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
    }

    public function forgetPassword(Request $request)
    {
        # code...
        $request->validate([
            'username' => 'required'
        ]);
        $user = User::where('phone', $request->username)->first();
        if (!$user) {
            $user = User::where('email', $request->username)->first();
        }
        if (!$user) {
            throw ValidationException::withMessages([
                'username' => ['User not found.'],
            ]);
        } else {
            $newPassword = $this->randomPassword();
            $updatePassword = $user->update(['password' => Hash::make($newPassword)]);
            if ($updatePassword) {
                return response()->json([
                    'newPassword' => $newPassword,
                    'message' => 'Password Updated'
                ]);
            } else {
                return ['result' => 'error', 'message' => 'Something went wrong!'];
            }
        }
    }
    public function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
