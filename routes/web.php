<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
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

// Show all roles in the system
Route::get('/admin/roles', [RoleController::class, 'index'])->name('roles.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('roles.index');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/my-roles', [UserRoleController::class, 'edit'])->name('user.roles.edit');
    Route::post('/admin/my-roles', [UserRoleController::class, 'update'])->name('user.roles.update');
});

// Show permissions page for a specific role by name
Route::get('/admin/roles/{roleName}', [PermissionController::class, 'index'])
    ->where('roleName', '[a-z]+')
    ->name('roles.permissions');

// Update roles' permissions
Route::post('/admin/roles/{roleName}/permissions', [PermissionController::class, 'updatePermissions'])
    ->where('roleName', '[a-z]+')
    ->name('roles.permissions.update');

Route::get('/blog', [BlogController::class, 'index'])->name('landing.blog.index');
Route::get('/blog/{blogPost}', [BlogController::class, 'show'])->name('landing.blog.show');

Route::middleware(['can:view blog'])->group(function() {
    Route::get('/admin/blog', [AdminBlogController::class, 'index'])->name('blog.index');
});

Route::middleware(['can:manage blog'])->group(function() {
    Route::get('/admin/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
    Route::post('/admin/blog/', [AdminBlogController::class, 'store'])->name('blog.store');
    Route::get('/admin/blog/{blogPost}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::put('/admin/blog/{blogPost}', [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('/admin/blog/{blogPost}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
});

Route::middleware(['can:view blog'])->group(function() {
    Route::get('/admin/blog/{blogPost}', [AdminBlogController::class, 'show'])->name('blog.show');
});