<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();

        return Inertia::render('Roles/Index', [
            'canViewBlog' => $currentUser->can('view blog'),
            'canViewNews' => $currentUser->can('view news'),

            'roles' => $roles
        ]);
    }
}
