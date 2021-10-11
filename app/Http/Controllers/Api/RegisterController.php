<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'nullable|string|email|max:191|unique:users',
            'phone' => 'required|string|max:10|min:10',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6'
        ]);
        $slug = Str::slug($request->name);
        $request->merge(['password' => Hash::make($request->password)]);
        $store = User::create($request->all());
        if ($store) {
            return ['result' => 'success', 'message' => 'Welcome! to Predict and Win. '];
        } else {
            return ['result' => 'error', 'message' => 'Something went wrong!'];
        }
    }
}
