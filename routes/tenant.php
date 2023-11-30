<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssignPermission;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionValueController;
use App\Http\Controllers\QuoteConfigController;
use App\Http\Controllers\PriceManagerController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Tenants\MakeNModel\MakesController;
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

    Route::get('/cache_clear', function () {
        Artisan::call('tenants:run', [
            'commandname' => 'config:clear',
            '--tenants' => ['quotegen']
        ]);
        Artisan::call('tenants:run', [
            'commandname' => 'config:clear',
        ]);
        Artisan::call('tenants:run', [
            'commandname' => 'route:clear',
        ]);
        Artisan::call('tenants:run', [
            'commandname' => 'view:clear',
        ]);
        Artisan::call('tenants:run', [
            'commandname' => 'clear-compiled',
        ]);

        Artisan::call('tenants:run', [
            'commandname' => 'cache:clear',
        ]);
        Artisan::call('tenants:run', [
            'commandname' => 'permission:cache-reset',
        ]);
        dd("Cache cleared!");
    });

    Route::get('/', function () {
        return view('tenant');
        // return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    // Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

    // Roles
    Route::get('/manage_roles', [RoleController::class, 'index']);
    Route::post('/add_roles', [RoleController::class, 'create']);
    Route::post('/load_roles', [RoleController::class, 'show']);
    Route::post('/get_roles/{id}', [RoleController::class, 'edit']);
    Route::post('/update_roles/{id}', [RoleController::class, 'update']);
    Route::post('/delete_roles/{id}', [RoleController::class, 'destroy']);

    // Permission
    Route::get('/assign_permission', [AssignPermission::class, 'index']);
    Route::post('/load_assign_permissions', [AssignPermission::class, 'show']);
    Route::post('/assign_permissions', [AssignPermission::class, 'create']);
    Route::post('/get_permissions_sync/{role_id}', [AssignPermission::class, 'edit']);

    // users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/show', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/users/{id}', [UserController::class, 'edit']);
    Route::post('/update/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Activity Log
    Route::get('/activity_logs', [UserController::class, 'showLog']);
    Route::post('/load_logs', [UserController::class, 'logs']);
    // });
});

Auth::routes();
