<?php

use App\Http\Controllers\AlerteController;
use App\Http\Controllers\ExcelCatastropheController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes([
    'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');

        Route::resource('users', UserController::class);


        Route::resource('catastrophes', CatastropheController::class);

        Route::get('excel/catastrophes', [ExcelCatastropheController::class, 'form'])->name('catastrophe.excel.form');
        Route::post('excel/catastrophes', [ExcelCatastropheController::class, 'import'])->name('catastrophe.excel.import');

        Route::resource('villes', VilleController::class);

        Route::resource('aleas', AleaController::class);

        Route::resource('agents', AgentController::class);

        Route::delete('alertes/{id}', [AlerteController::class, 'destroy'])->name('alertes.destroy');
    });
