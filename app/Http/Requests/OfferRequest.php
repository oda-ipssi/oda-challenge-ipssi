<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OfferRequest extends Request
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
            'data.title' => 'required|max:45',
            'data.has_support' => 'required',
            'data.has_update' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('offer.data_validator.title.required', [], 'user'),
            'title.max' => trans('offer.data_validator.title.max', [], 'user'),
            'has_support.required' => trans('offer.data_validator.has_support.max', [], 'user'),
            'has_update.required' => trans('offer.data_validator.has_update.required', [], 'user'),

        ];
    }
}
