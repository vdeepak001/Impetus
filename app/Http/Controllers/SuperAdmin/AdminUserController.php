<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('super-admin.admin-users.index', ['title' => 'Admin Users']);
    }

    public function create()
    {
        return view('super-admin.admin-users.create', ['title' => 'Create Admin User']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_type' => ['required', 'string', 'in:superadmin,admin,sme,support'],
            'active_status' => ['boolean']
        ]);

        $password = \Illuminate\Support\Str::random(12);
        $validated['password'] = Hash::make($password);
        $validated['password_raw'] = $password;
        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        $validated['active_status'] = $request->boolean('active_status');

        $user = User::create($validated);
        
        // Optional: Assign Spatie roles if applicable
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $user->assignRole($validated['role_type']);
        }

        return redirect()->route('admin-users.index')->with('success', 'Admin user created successfully.');
    }

    public function edit(User $admin_user)
    {
        return view('super-admin.admin-users.edit', [
            'user' => $admin_user,
            'title' => 'Edit Admin User'
        ]);
    }

    public function update(Request $request, User $admin_user)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($admin_user->id)],
            'role_type' => ['required', 'string', 'in:superadmin,admin,sme,support'],
            'active_status' => ['boolean']
        ]);

        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        $validated['active_status'] = $request->boolean('active_status');

        $admin_user->update($validated);
        
        // Optional: Assign Spatie roles if applicable
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $admin_user->syncRoles([$validated['role_type']]);
        }

        return redirect()->route('admin-users.index')->with('success', 'Admin user updated successfully.');
    }

    public function destroy(User $admin_user)
    {
        $admin_user->delete();
        return redirect()->route('admin-users.index')->with('success', 'Admin user deleted successfully.');
    }
}
