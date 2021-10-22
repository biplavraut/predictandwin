<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    //
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'deviceToken' => 'required',
        ]);

        $user = User::where('phone', $request->username)->first();
        if (!$user) {
            $user = User::where('email', $request->username)->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
            // return response()->json([
            //     'result' => 'error',
            //     'message' => 'Something went wrong!',
            //     'data' => ''
            // ]);
        }
        $user->update(['device_token' => $request->deviceToken]);
        $data = [
            'user' => new UserResource($user),
            'token' => $user->createToken($request->deviceToken)->plainTextToken
        ];
        return response()->json([
            'result' => 'success',
            'message' => 'Welcome! to Predict and Win.',
            'data' => $data
        ]);
    }
    // Expire Token
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['result' => 'success', 'message' => 'Logout Success']);
    }
}
