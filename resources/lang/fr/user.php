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

    'isAjax' => 'Une requête ajax est attendue.',
    'create' => [
        'success' => "L'utilisateur a bien été crée.",
        'exist' => "L'utilisateur existe déjà.",
        'error' => "L'utilisateur n'a pas pu être crée."
    ],
    'edit' => [
        'success' => "L'utilisateur a bien été modifié.",
        'error' => "L'utilisateur n'a pas pu être modifié."
    ],
    'deleted' => [
        'success' => "L'utilisateur a bien été supprimé.",
        'error' => "L'utilisateur n'a pas pu être supprimé."
    ],
    'data_validator' => [
        'email' => 'Cet email existe déjà',
        'firstname' => "Le prénom doit contenir 45 caractères maximum",
        'lastname' => "Le nom doit contenir 45 caractères maximum",
        'address' => "L'adresse doit contenir 45 caractères maximum",
        'city' => "La ville doit contenir 45 caractères maximum",
        'phone' => "Le téléphone doit contenir 45 caractères maximum",
    ]

];
