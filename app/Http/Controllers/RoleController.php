<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->value();

        $roles = Role::query()
            ->with('permissions:id,name')
            ->withCount('users')
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('roles.index', [
            'roles' => $roles,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new role.
     */
    public function create(): View
    {
        return view('roles.create', [
            'role' => new Role(['guard_name' => 'web']),
            'permissions' => Permission::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        return to_route('roles.index')
            ->with('success', __('Role berhasil ditambahkan.'));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role): View
    {
        $role->load('permissions:id,name');

        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified role in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $validated = $request->validated();

        $role->update([
            'name' => $validated['name'],
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        return to_route('roles.index')
            ->with('success', __('Role berhasil diperbarui.'));
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        if ($role->name === 'super-admin') {
            return to_route('roles.index')
                ->with('error', __('Role super-admin tidak dapat dihapus.'));
        }

        $role->delete();

        return to_route('roles.index')
            ->with('success', __('Role berhasil dihapus.'));
    }
}
