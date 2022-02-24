<?php

use App\Http\Controllers\APIController;
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

Route::get('home', [APIController::class, 'home']);

Route::get('alea/{id}', [APIController::class, 'alea']);

Route::get('ville/{id}', [APIController::class, 'ville']);

Route::post('sync-alert', [APIController::class, 'sync']);
