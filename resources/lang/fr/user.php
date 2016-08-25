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
        'email' => [
            'unique' => 'Cet email existe déjà',
            'required' => 'Le champ email est obligatoire'
        ],
        'firstname' => [
            "max" => "Le prénom doit contenir 45 caractères maximum",
            "required" => "Le champ prénom est obligatoire"
        ],
        'lastname' => [
            "max" => "Le nom doit contenir 45 caractères maximum",
            "required" => "Le champ nom est obligatoire"
        ],

        'address' => "L'adresse doit contenir 45 caractères maximum",
        'zipcode' => "Le code postale doit contenir 45 caractères maximum",
        'city' => "La ville doit contenir 45 caractères maximum",
        'phone' => "Le téléphone doit contenir 45 caractères maximum",
    ],
    'response' => [
        'error' => "Erreur",
        'success' => "Succès",
        'notfound' => "Ressource non trouvée",
    ],
    'register' => [
        'success' => 'Nous sommes heureux de vous accueillir au sein de ODA ! N\'hésitez pas à nous contacter. A très vite !'
    ]

];
