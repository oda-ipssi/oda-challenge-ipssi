<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User account Lines
    |--------------------------------------------------------------------------
    |
    | The following
    |
    */

    'edit' => [
        'success' => "L'utilisateur a bien été modifié.",
        'error' => "L'utilisateur n'a pas pu être modifié."
    ],
    'data_validator' => [
        'email' => 'Cet email existe déjà',
        'firstname' => "Le prénom doit contenir 45 caractères maximum",
        'lastname' => "Le nom doit contenir 45 caractères maximum",
        'address' => "L'adresse doit contenir 45 caractères maximum",
        'city' => "La ville doit contenir 45 caractères maximum",
        'phone' => "Le téléphone doit contenir 45 caractères maximum",
    ],
    'response' => [
        'error' => "Erreur",
        'success' => "Succès",
        'notfound' => "Ressource non trouvée",
    ]

];
