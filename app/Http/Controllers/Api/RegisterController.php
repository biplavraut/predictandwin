<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function register(UserRegisterRequest $request)
    {
        $slug = Str::slug($request->name) . '-paw-' . time();
        $path = public_path() . '/storage/images/user/' . $slug;
        if (!file_exists($path)) {
            \File::makeDirectory($path, $mode = 0777, true, true);
            \File::makeDirectory($path . '/thumbs', $mode = 0777, true, true);
        }
        $request->merge(['slug' => $slug, 'password' => Hash::make($request->password)]);
        $store = User::create($request->all());
        $data = [
            'user' => new UserResource(User::where('id', $store->id)->first()),
            'token' => $store->createToken($request->deviceToken)->plainTextToken
        ];
        if ($store) {
            return response()->json([
                'result' => 'success',
                'message' => 'Welcome! to Predict and Win.',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'result' => 'error',
                'message' => 'Something went wrong!',
                'data' => ''
            ]);
        }
    }
}
