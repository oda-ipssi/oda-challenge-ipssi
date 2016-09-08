<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
            'name' => 'required|max:45',
            'email' => 'required',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('contact.data_validator.name.required', [], 'contact'),
            'email.required' => trans('contact.data_validator.email.required', [], 'contact'),
            'message.required' => trans('contact.data_validator.has_support.required', [], 'contact'),
        ];
    }
}
