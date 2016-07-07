<?php

namespace App\Http\Requests;

class RoleRequest extends Request
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
      'name' => 'required|min:2|max:20|alpha',
      'display_name' => 'max:20|alpha',
      'description' => 'alpha|max:250'
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
        'name.required' => 'Veuillez saisir un nom',
        'name.alpha' => 'Le nom doit contenir des lettres uniquement',
        'name.min' => 'Le nom doit contenir au minimum 2 caractères',
        'name.max' => 'Le nom ne doit pas contenir plus de 20 caractères',
        'display_name.alpha' => 'Le label doit contenir des lettres uniquement',
        'display_name.max' => 'Le label ne doit pas contenir plus de 20 caractères',
        'description.max' => 'Votre description ne peux pas excéder 250 caractères'
    ];
  }


}
