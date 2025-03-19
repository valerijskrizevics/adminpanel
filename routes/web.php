<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\BlogController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-roles', [UserRoleController::class, 'edit'])->name('user.roles.edit');
    Route::post('/my-roles', [UserRoleController::class, 'update'])->name('user.roles.update');
});

// Show all roles in the system
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');

// Show permissions page for a specific role by name
Route::get('/roles/{roleName}', [PermissionController::class, 'index'])
    ->where('roleName', '[a-z]+')
    ->name('roles.permissions');

// Update roles' permissions
Route::post('/roles/{roleName}/permissions', [PermissionController::class, 'updatePermissions'])
    ->where('roleName', '[a-z]+')
    ->name('roles.permissions.update');

Route::resource('blog', BlogController::class)->except('update', 'destroy');

Route::put('/blog/{blogPost}', [BlogController::class, 'update'])->name('blog.update');

Route::delete('/blog/{blogPost}', [BlogController::class, 'destroy'])->name('blog.destroy');
