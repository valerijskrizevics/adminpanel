<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show role selection page for the authenticated user.
     */
    public function edit(): Response
    {
        $user = Auth::user();
        $roles = Role::all(['id', 'name']);

        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        

        return Inertia::render('UserRoles/Edit', [
            'canViewBlog' => $currentUser->can('view blog'),
            'canViewNews' => $currentUser->can('view news'),

            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'current_roles' => $user->roles->pluck('name'), // Send current roles
            ],
            'roles' => $roles,
        ]);
    }

    /**
     * Update the roles of the authenticated user.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $messages = [
            'roles.required' => 'At least one role is required.',
        ];

        $request->validate([
            'roles' => 'array|required',
            'roles.*' => 'exists:roles,name',
        ], $messages);

        // Sync multiple roles for the user
        $user->syncRoles($request->roles);

        return redirect()->route('roles.index');
    }
}
