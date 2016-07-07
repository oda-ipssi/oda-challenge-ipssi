<?php

namespace App\Http\Requests;

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
            'email' => 'required|unique',
            'firstname' => 'max:45',
            'password' => 'required',
            'lastname' => 'max:45',
            'address' => 'max:45',
            'phone' => 'max:45',
            'ip' => 'max:15',
        ];
    }

    public function messages()
    {
        return [
            'email' => trans('user.data_validator.email'),
            'firstname' => trans('user.data_validator.firstname'),
            'lastname' => trans('user.data_validator.lastname'),
            'address' => trans('user.data_validator.address'),
            'city' => trans('user.data_validator.city'),
            'phone' => trans('user.data_validator.phone')
        ];
    }
}
