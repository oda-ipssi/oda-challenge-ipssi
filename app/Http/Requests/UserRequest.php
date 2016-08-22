<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'email' => 'required|unique:users,email',
            'username' => 'required|max:45',
            'firstname' => 'required|max:45',
            'lastname' => 'required|max:45',
            'address' => 'max:255',
            'city' => 'max:45',
            'phone' => 'max:45',
        ];
    }

    public function messages()
    {
        return [
            'email' => trans('user.data_validator.email'),
            'username' => trans('user.data_validator.username'),
            'firstname' => trans('user.data_validator.firstname'),
            'lastname' => trans('user.data_validator.lastname'),
            'address' => trans('user.data_validator.address'),
            'city' => trans('user.data_validator.city'),
            'phone' => trans('user.data_validator.phone')
        ];
    }
}
