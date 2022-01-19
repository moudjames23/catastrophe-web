<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Api\\AuthController@login')->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', 'Api\\RoleController');
        Route::apiResource('permissions', 'Api\\PermissionController');

        Route::apiResource('users', 'Api\\UserController');

        Route::apiResource('catastrophes', 'Api\\CatastropheController');

        Route::apiResource('villes', 'Api\\VilleController');

        // Ville Catastrophes
        Route::get(
            '/villes/{ville}/catastrophes',
            'Api\\VilleCatastrophesController@index'
        )->name('villes.catastrophes.index');
        Route::post(
            '/villes/{ville}/catastrophes',
            'Api\\VilleCatastrophesController@store'
        )->name('villes.catastrophes.store');

        Route::apiResource('aleas', 'Api\\AleaController');

        // Alea Catastrophes
        Route::get(
            '/aleas/{alea}/catastrophes',
            'Api\\AleaCatastrophesController@index'
        )->name('aleas.catastrophes.index');
        Route::post(
            '/aleas/{alea}/catastrophes',
            'Api\\AleaCatastrophesController@store'
        )->name('aleas.catastrophes.store');
    });
