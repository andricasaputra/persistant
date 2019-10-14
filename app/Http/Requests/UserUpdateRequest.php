<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'package' => ['sometimes'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->route('user'), 'regex:/(.*)@pertanian\.go.id/i'],
            'roles' => ['required'],
            'password' => ['sometimes', 'string', 'min:4', 'confirmed'],
        ];
    }
}
