<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|string|max:191',
            'email' => 'nullable|string|email|max:191|unique:users',
            'phone' => 'required|string|max:10|min:10|unique:users',
            'password' => 'required|string|min:6',
            'confirmPassword' => 'required|string|min:6',
            'deviceToken' => 'required'
        ];
    }
}
