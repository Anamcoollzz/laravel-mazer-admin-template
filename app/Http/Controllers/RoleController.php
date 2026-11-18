<?php

namespace App\Http\Controllers;

use App\Exports\RolesExport;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    /**
     * Duplicate the specified role along with its permissions.
     */
    public function duplicate(Role $role): RedirectResponse
    {
        $role->loadMissing('permissions:id,name');

        $copy = Role::create([
            'name' => $this->generateUniqueCopyName($role),
            'guard_name' => $role->guard_name,
        ]);

        $copy->syncPermissions($role->permissions->pluck('name')->all());

        return to_route('roles.index')
            ->with('success', __('Role berhasil diduplikasi menjadi :name.', [
                'name' => $copy->name,
            ]));
    }

    /**
     * Export roles to an Excel file.
     */
    public function export(Request $request): BinaryFileResponse
    {
        $search = $request->string('search')->trim()->value();

        return Excel::download(
            new RolesExport($search),
            'roles-'.now()->format('Y-m-d').'.xlsx',
        );
    }

    /**
     * Generate a unique role name for a duplicated role.
     */
    private function generateUniqueCopyName(Role $role): string
    {
        $base = "{$role->name}-copy";
        $candidate = $base;
        $counter = 2;

        while (Role::query()->where('name', $candidate)->where('guard_name', $role->guard_name)->exists()) {
            $candidate = "{$base}-{$counter}";
            $counter++;
        }

        return $candidate;
    }
}
