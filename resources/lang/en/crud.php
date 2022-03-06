<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Ajouter',
        'edit' => 'Modification',
        'update' => 'Enregister',
        'new' => 'Nouveau',
        'cancel' => 'Retour',
        'save' => 'Ajouter',
        'delete' => 'Supprimer',
        'delete_selected' => '',
        'search' => 'Rechercher...',
        'back' => 'Retour à la liste',
        'are_you_sure' => 'Êtes-vous sûr?',
        'no_items_found' => 'Aucune donnée',
        'created' => 'Ajouter avec succès',
        'saved' => 'Modifier avec succès',
        'removed' => 'Supprimé avec succès',
    ],

    'users' => [
        'name' => 'Utilisateurs',
        'index_title' => 'Liste des utilisateurs',
        'new_title' => 'Nouvel utilisateur',
        'create_title' => 'Ajouter un nouvel utilisateur',
        'edit_title' => 'Mise à jour utilisateur',
        'show_title' => 'Détails utilisateur',
        'inputs' => [
            'name' => 'Nom et prénoms',
            'email' => 'Email',
            'password' => 'Mot de passe',
        ],
    ],

    'catastrophes' => [
        'name' => 'Catastrophes',
        'index_title' => 'Catastrophes List',
        'new_title' => 'New Catastrophe',
        'create_title' => 'Create Catastrophe',
        'edit_title' => 'Modification Catastrophe',
        'show_title' => 'Détails Catastrophe',
        'inputs' => [
            'valeur' => 'Valeur',
            'url' => 'Url',
            'alea_id' => 'Alea',
            'ville_id' => 'préfecture',
        ],
    ],

    'villes' => [
        'name' => 'préfectures',
        'index_title' => 'Liste des préfectures',
        'new_title' => 'Nouvelle préfecture',
        'create_title' => 'Ajouter une préfecture',
        'edit_title' => 'Modification préfecture',
        'show_title' => 'Détails préfecture',
        'inputs' => [
            'nom' => 'Nom',
        ],
    ],

    'aleas' => [
        'name' => 'Aleas',
        'index_title' => 'Liste des aléas',
        'new_title' => 'Nouvel aléa',
        'create_title' => 'Ajouter un aléa',
        'edit_title' => 'Modification aléa',
        'show_title' => 'Détails aléa',
        'inputs' => [
            'nom' => 'Nom',
            'url' => 'Url',
            'image' => 'Image',
        ],
    ],

    'ville_catastrophes' => [
        'name' => 'préfecture Catastrophes',
        'index_title' => 'Catastrophes List',
        'new_title' => 'New Catastrophe',
        'create_title' => 'Create Catastrophe',
        'edit_title' => 'Modification Catastrophe',
        'show_title' => 'Détails Catastrophe',
        'inputs' => [
            'alea_id' => 'Alea',
            'valeur' => 'Valeur',
            'url' => 'Url',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Modification Role',
        'show_title' => 'Détails Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Modification Permission',
        'show_title' => 'Détails Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
