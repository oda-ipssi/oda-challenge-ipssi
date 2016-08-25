<?php

namespace App\Http\Requests;

class RoleRequest extends Request
{
    public function __construct() {
        parent::__construct();
    }

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
            'name' => 'required|min:2|max:20|unique:roles',
            'display_name' => 'max:50',
            'description' => 'max:250'
        ];
    }

    /**
    * Get the customs messages error that apply to the request.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'name.required' => trans('form.required'),
            'name.min' => 'Le nom doit contenir au minimum 2 caractères',
            'name.max' => 'Le nom ne doit pas contenir plus de 20 caractères',
            'display_name.max' => 'Le label ne doit pas contenir plus de 20 caractères',
            'display_name.required' => trans('form.required'),
            'description.max' => 'Votre description ne peux pas excéder 250 caractères'
        ];
    }

}
