<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MakesController;
use App\Http\Controllers\AssignPermission;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionValueController;
use App\Http\Controllers\QuoteConfigController;
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

    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index2'])->name('home')->middleware(['can:View Dashboard']);
        Route::get('/makes_n_models', [MakesController::class, 'index'])->middleware(['can:View Make n Model']);

        Route::post('/load_makes_models', [MakesController::class, 'show'])->middleware(['can:View Make n Model']);
        Route::post('/makes', [MakesController::class, 'store'])->middleware(['can:Add Makes']);
        Route::put('/makes/{id}', [MakesController::class, 'edit'])->middleware(['can:Edit Makes']);
        Route::post('/makes/{id}', [MakesController::class, 'update'])->middleware(['can:Edit Makes']);
        Route::delete('/makes/{id}', [MakesController::class, 'destroy'])->middleware(['can:Delete Makes']);

        Route::post('/load_makes', [ModelsController::class, 'show'])->middleware(['can:View Make n Model']);
        Route::post('/models', [ModelsController::class, 'store'])->middleware(['can:Add Models']);
        Route::put('/models/{id}', [ModelsController::class, 'edit'])->middleware(['can:Edit Models']);
        Route::post('/models/{id}', [ModelsController::class, 'update'])->middleware(['can:Edit Models']);
        Route::delete('/models/{id}', [ModelsController::class, 'destroy'])->middleware(['can:Delete Models']);

        Route::get('/services', [ServiceController::class, 'index'])->middleware(['can:View Services']);
        Route::post('/services', [ServiceController::class, 'show'])->middleware(['can:View Services']);

        // Roles
        Route::get('/manage_roles', [RoleController::class, 'index'])->middleware(['can:View Role']);
        Route::post('/add_roles', [RoleController::class, 'create'])->middleware(['can:Add Role']);
        Route::post('/load_roles', [RoleController::class, 'show'])->middleware(['can:View Role']);
        Route::post('/get_roles/{id}', [RoleController::class, 'edit'])->middleware(['can:Edit Role']);
        Route::post('/update_roles/{id}', [RoleController::class, 'update'])->middleware(['can:Edit Role']);
        Route::post('/delete_roles/{id}', [RoleController::class, 'destroy'])->middleware(['can:Delete Role']);

        // Permission
        Route::get('/assign_permission', [AssignPermission::class, 'index'])->middleware(['can:View Permission']);
        Route::post('/load_assign_permissions', [AssignPermission::class, 'show'])->middleware(['can:View Permission']);
        Route::post('/assign_permissions', [AssignPermission::class, 'create'])->middleware(['can:Add Permission']);
        Route::post('/get_permissions_sync/{role_id}', [AssignPermission::class, 'edit'])->middleware(['can:Edit Permission']);

        // users
        Route::get('/users', [UserController::class, 'index'])->middleware(['can:View Staff']);
        Route::post('/show', [UserController::class, 'show'])->middleware(['can:View Staff']);
        Route::post('/users', [UserController::class, 'store'])->middleware(['can:Add Staff']);
        Route::post('/users/{id}', [UserController::class, 'edit'])->middleware(['can:Edit Staff']);
        Route::post('/update/{id}', [UserController::class, 'update'])->middleware(['can:Edit Staff']);
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware(['can:Delete Staff']);

        // Activity Log
        Route::get('/activity_logs', [UserController::class, 'showLog'])->middleware(['can:Logs Permission']);
        Route::post('/load_logs', [UserController::class, 'logs'])->middleware(['can:Logs Permission']);

        Route::get('/category', [CategoryController::class, 'index'])->middleware(['can:View Category']);
        Route::post('/load_categories', [CategoryController::class, 'show'])->middleware(['can:View Category']);
        Route::post('/add_categories', [CategoryController::class, 'store'])->middleware(['can:Add Category']);
        Route::post('/get_categories/{id}', [CategoryController::class, 'edit'])->middleware(['can:Edit Category']);
        Route::post('/update_categories/{id}', [CategoryController::class, 'update'])->middleware(['can:Edit Category']);
        Route::delete('/delete_categories/{id}', [CategoryController::class, 'destroy'])->middleware(['can:Delete Category']);

        Route::post('/add_services/{id}', [ServiceController::class, 'services'])->middleware(['can:Add Services']);
        Route::post('/update_services/{service_id}', [ServiceController::class, 'update'])->middleware(['can:Edit Services']);
        Route::post('/modify_service', [ServiceController::class, 'modify'])->middleware(['can:Add Services']);

        Route::group(['prefix' => 'option', 'as' => 'option.'], function () {
            Route::get('/index', [OptionController::class, 'index'])->name('index')->middleware(['can:Add Option']);
            Route::post('/add', [OptionController::class, 'store'])->name('add')->middleware(['can:Add Option']);
            Route::post('/load', [OptionController::class, 'show'])->name('load')->middleware(['can:View Option']);
            Route::post('/get/{id}', [OptionController::class, 'edit'])->name('get')->middleware(['can:Edit Option']);
            Route::post('/update/{id}', [OptionController::class, 'update'])->name('update')->middleware(['can:Edit Option']);
            Route::post('/delete/{id}', [OptionController::class, 'destroy'])->name('delete')->middleware(['can:Delete Option']);

            Route::post('/add_values/{id}', [OptionValueController::class, 'store'])->name('value_add')->middleware(['can:Add Option Value']);
            Route::post('/value_modify', [OptionValueController::class, 'modify'])->name('value_modify')->middleware(['can:Edit Option Value']);
            Route::post('/update_values/{option_v_id}', [OptionValueController::class, 'update'])->name('update_values')->middleware(['can:Edit Option Value']);
        });

        Route::group(['prefix' => 'quote', 'as' => 'quote.'], function () {
            Route::get('/config', [QuoteConfigController::class, 'config'])->name('config')->middleware(['can:Add Quote Config']);
            Route::post('/category', [QuoteConfigController::class, 'category'])->name('category')->middleware(['can:Add Quote category']);
            Route::post('/fields', [QuoteConfigController::class, 'fields'])->name('fields')->middleware(['can:Add Quote Fields']);
        });
    });

    Auth::routes();
});
