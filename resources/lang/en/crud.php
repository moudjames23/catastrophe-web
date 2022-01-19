<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'catastrophes' => [
        'name' => 'Catastrophes',
        'index_title' => 'Catastrophes List',
        'new_title' => 'New Catastrophe',
        'create_title' => 'Create Catastrophe',
        'edit_title' => 'Edit Catastrophe',
        'show_title' => 'Show Catastrophe',
        'inputs' => [
            'valeur' => 'Valeur',
            'url' => 'Url',
            'alea_id' => 'Alea',
            'ville_id' => 'Ville',
        ],
    ],

    'villes' => [
        'name' => 'Villes',
        'index_title' => 'Villes List',
        'new_title' => 'New Ville',
        'create_title' => 'Create Ville',
        'edit_title' => 'Edit Ville',
        'show_title' => 'Show Ville',
        'inputs' => [
            'nom' => 'Nom',
        ],
    ],

    'aleas' => [
        'name' => 'Aleas',
        'index_title' => 'Aleas List',
        'new_title' => 'New Alea',
        'create_title' => 'Create Alea',
        'edit_title' => 'Edit Alea',
        'show_title' => 'Show Alea',
        'inputs' => [
            'nom' => 'Nom',
            'url' => 'Url',
            'image' => 'Image',
        ],
    ],

    'ville_catastrophes' => [
        'name' => 'Ville Catastrophes',
        'index_title' => 'Catastrophes List',
        'new_title' => 'New Catastrophe',
        'create_title' => 'Create Catastrophe',
        'edit_title' => 'Edit Catastrophe',
        'show_title' => 'Show Catastrophe',
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
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
