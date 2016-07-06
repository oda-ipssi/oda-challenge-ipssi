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
      'display_name' => 'required|min:2|max:20|alpha',
      'description' => 'required|min:10|max:250'
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
        'type_person.required' => 'Veuillez nous préciser qui vous êtes',
        'type_search.required' => 'Veuillez nous préciser l\'objet de votre demande',
        'prenom.required' => 'Veuillez saisir votre prénom',
        'prenom.alpha' => 'Le prénom doit contenir des lettres uniquement',
        'prenom.min' => 'Le prénom doit contenir au minimum 2 caractères',
        'prenom.max' => 'Le prénom ne doit pas contenir plus de 20 caractères',
        'nom.required' => 'Veuillez saisir votre nom',
        'nom.alpha' => 'Le prénom doit contenir des lettres uniquement',
        'nom.min' => 'Le nom doit contenir au minimum 2 caractères',
        'nom.max' => 'Le nom ne doit pas contenir plus de 20 caractères',
        'phone.required' => 'Veuillez saisir votre numéro de téléphone',
        'phone.min' => 'Le numéro de téléphone doit contenir au minimum 8 caractères',
        'phone.max' => 'Le numéro de téléphone ne doit pas contenir plus de 30 caractères',
        'email.email' => 'Veuillez saisir votre adresse e-mail',
        'email.email' => 'Veuillez saisir une adresse e-mail valide',
        'message.required' => 'Veuillez saisir votre message',
        'message.max' => 'Votre message doit contenir au minimum 10 caractères',
        'message.max' => 'Votre message ne peux pas excéder 250 caractères'
    ];
  }


}
