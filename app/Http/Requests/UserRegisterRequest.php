<?php

namespace App\Http\Requests;

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
            'id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/(.*)@pertanian\.go.id/i'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ];
    }
}
