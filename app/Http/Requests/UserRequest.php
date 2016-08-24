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
        //dd($this->request->get('data'));
        return [
            '*.email' => 'required|unique:users,email',
            '*.username' => 'required|max:45',
            '*.firstname' => 'required|max:45',
            '*.lastname' => 'required|max:45',
            '*.address' => 'max:255',
            '*.zipcode' => 'max:45',
            '*.city' => 'max:45',
            '*.phone' => 'max:45',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('user.data_validator.email.required', [], 'user'),
            'email.unique' => trans('user.data_validator.email.unique', [], 'user'),
            'username.required' => trans('user.data_validator.username.required', [], 'user'),
            'username.max' => trans('user.data_validator.username.max', [], 'user'),
            'firstname.required' => trans('user.data_validator.firstname.required', [], 'user'),
            'firstname.max' => trans('user.data_validator.firstname.max', [], 'user'),
            'lastname.required' => trans('user.data_validator.lastname.required', [], 'user'),
            'lastname.max' => trans('user.data_validator.lastname.max', [], 'user'),
            'address.max' => trans('user.data_validator.address', [], 'user'),
            'zipcode.max' => trans('user.data_validator.zipcode', [], 'user'),
            'city.max' => trans('user.data_validator.city', [], 'user'),
            'phone.max' => trans('user.data_validator.phone', [], 'user')
        ];
    }
}
