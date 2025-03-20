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
        
        return Inertia::render('Roles/Index', [
            'roles' => $roles
        ]);
    }
}
