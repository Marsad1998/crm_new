<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MakesController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\ServiceController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/', function () {
        return view('welcome');
        // return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index2'])->name('home');

        Route::get('/makes_n_models', [MakesController::class, 'index']);

        Route::post('/load_makes_models', [MakesController::class, 'show']);
        Route::post('/makes', [MakesController::class, 'store']);
        Route::put('/makes/{id}', [MakesController::class, 'edit']);
        Route::post('/makes/{id}', [MakesController::class, 'update']);
        Route::delete('/makes/{id}', [MakesController::class, 'destroy']);

        Route::post('/load_makes', [ModelsController::class, 'show']);
        Route::post('/models', [ModelsController::class, 'store']);
        Route::put('/models/{id}', [ModelsController::class, 'edit']);
        Route::post('/models/{id}', [ModelsController::class, 'update']);
        Route::delete('/models/{id}', [ModelsController::class, 'destroy']);

        Route::get('/services', [ServiceController::class, 'index']);
        Route::post('/services', [ServiceController::class, 'show']);

        Route::post('/roles', [UserController::class, 'show']);

        Route::get('/users', [UserController::class, 'index']);
        Route::post('/show', [UserController::class, 'show']);
        Route::post('/users', [UserController::class, 'store']);
        Route::post('/users/{id}', [UserController::class, 'edit']);
        Route::patch('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });

    Auth::routes();
});
