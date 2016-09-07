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

    'get' => [
        'success' => "Succès",
        'error' => "La commande n'a pas été trouvé"
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
    'create' => [
        'error' => "Erreur",
        'success' => "Succès",
        'notfound' => "Ressource non trouvée",
    ],
    'update' => [
        'error' => "Erreur",
        'success' => "Succès",
        'notfound' => "Ressource non trouvée",
    ],
    'delete' => [
        'not_allowed' => 'Suppression interdite !'
    ],
    'change' => [
        'notallowed' => 'Vous demandez la même offre !',
        'stop' => 'Vous avez stoppé votre abonnement !',
        'success' => 'Offre modifiée !'
    ],
    'forbidden' => [
        'error' => 'Vous n\'avez pas l\autorisation!'
    ]

];
