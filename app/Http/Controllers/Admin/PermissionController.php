<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Show roles and permissions page for a specific role by name
    public function index($roleName)
    {
        // Find the role by its name
        $role = Role::whereRaw('LOWER(name) = ?', [$roleName])->firstOrFail();

        // Retrieve all available permissions
        $permissions = Permission::all();

        // Group permissions by categories (news and blog)
        $groupedPermissions = [
            'news' => [],
            'blog' => [],
        ];

        foreach ($permissions as $permission) {
            if (str_contains($permission->name, 'news')) {
                $groupedPermissions['news'][] = $permission;
            } elseif (str_contains($permission->name, 'blog')) {
                $groupedPermissions['blog'][] = $permission;
            }
        }

        return inertia('RolePermissions/Index', [
            'role' => $role,
            'groupedPermissions' => $groupedPermissions,
            'permissions' => $role->permissions->pluck('name')->toArray(),
        ]);
    }

    // Update permissions for a role by name
    public function updatePermissions(Request $request, $roleName)
    {
        // Find the role by its name
        $role = Role::whereRaw('LOWER(name) = ?', [$roleName])->firstOrFail();

        // Validate the incoming request (ensure it's an array of permissions, but it's optional)
        $request->validate([
            'permissions' => 'nullable|array', // Make permissions optional
            'permissions.*' => 'nullable|exists:permissions,name', // Allow null values
        ]);

        // If permissions are provided, sync them for the given role
        if (!empty($request->permissions)) {
            // Sync the permissions for the given role
            $role->syncPermissions($request->permissions);
        } else {
            // If no permissions were provided, we clear the role's permissions
            $role->syncPermissions([]);
        }

        // Return a success message
        return redirect()->route('roles.permissions', ['roleName' => $role->name])->with('success', 'Permissions updated successfully!');
    }
}
