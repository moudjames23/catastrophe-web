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

Route::get('/home', 'DashboardController@index')->name('home');

Route::prefix('/admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('/', 'DashboardController@index')->name('home');

        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');

        Route::resource('users', UserController::class);


        Route::resource('catastrophes', CatastropheController::class);

        Route::get('excel/catastrophes', [ExcelCatastropheController::class, 'form'])->name('catastrophe.excel.form');
        Route::post('excel/catastrophes', [ExcelCatastropheController::class, 'import'])->name('catastrophe.excel.import');

        Route::resource('villes', VilleController::class);

        Route::resource('aleas', AleaController::class);

        Route::resource('agents', AgentController::class);

        Route::get('alertes', [AlerteController::class, 'index'])->name('alertes.index');
        Route::get('alerte-export', [AlerteController::class, 'export'])->name('alerte.export');
        Route::delete('alertes/{id}', [AlerteController::class, 'destroy'])->name('alertes.destroy');

        Route::get('alea-alerte-expert/{id}', [AlerteController::class, 'aleaAlerteExport'])->name('alea.alerte.export');

        Route::resource('couches', CoucheController::class);
    });
