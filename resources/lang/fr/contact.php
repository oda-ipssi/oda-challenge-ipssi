<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Contact form
    |--------------------------------------------------------------------------
    |
    | The following
    |
    */

    'get' => [
        'success' => "Succès",
        'error' => "Erreur"
    ],
    'data_validator' => [
        'name' => [
            'required' => 'Le champ nom est obligatoire'
        ],
        'email' => [
            "required" => "Le champ email est obligatoire"
        ],
        'message' => [
            "required" => "Le champ message est obligatoire"
        ],

    ],
    'forbidden' => [
        'error' => 'Vous n\'avez pas l\autorisation!'
    ]

];
