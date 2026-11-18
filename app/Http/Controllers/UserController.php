<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\UsersTemplateExport;
use App\Http\Requests\ImportUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->value();
        $role = $request->string('role')->trim()->value();

        $users = User::query()
            ->with('roles:id,name')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($q) use ($search): void {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($role !== '', fn ($query) => $query->role($role))
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $roles = Role::query()->orderBy('name')->get(['id', 'name']);

        return view('users.index', [
            'users' => $users,
            'roles' => $roles,
            'search' => $search,
            'selectedRole' => $role,
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        return view('users.create', [
            'user' => new User,
            'roles' => Role::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $avatarPath = $request->hasFile('avatar')
            ? $request->file('avatar')->store('avatars', 'public')
            : null;

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'avatar' => $avatarPath,
        ]);

        $user->syncRoles($validated['roles'] ?? []);

        return to_route('users.index')
            ->with('success', __('User berhasil ditambahkan.'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        $user->load('roles:id,name');

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $attributes = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (! empty($validated['password'])) {
            $attributes['password'] = $validated['password'];
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $attributes['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($attributes);
        $user->syncRoles($validated['roles'] ?? []);

        return to_route('users.index')
            ->with('success', __('User berhasil diperbarui.'));
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()?->is($user)) {
            return to_route('users.index')
                ->with('error', __('User yang sedang login tidak dapat dihapus.'));
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return to_route('users.index')
            ->with('success', __('User berhasil dihapus.'));
    }

    /**
     * Duplicate the specified user.
     */
    public function duplicate(User $user): RedirectResponse
    {
        $copy = $user->duplicate();

        return to_route('users.index')
            ->with('success', __('User berhasil diduplikasi menjadi :name (:email).', [
                'name' => $copy->name,
                'email' => $copy->email,
            ]));
    }

    /**
     * Download the Excel import template for users.
     */
    public function template(): BinaryFileResponse
    {
        return Excel::download(
            new UsersTemplateExport,
            'users-import-template.xlsx',
        );
    }

    /**
     * Export users to an Excel file.
     */
    public function export(Request $request): BinaryFileResponse
    {
        $search = $request->string('search')->trim()->value();
        $role = $request->string('role')->trim()->value();

        return Excel::download(
            new UsersExport($search, $role),
            'users-'.now()->format('Y-m-d').'.xlsx',
        );
    }

    /**
     * Import users from an uploaded Excel file.
     */
    public function import(ImportUserRequest $request): RedirectResponse
    {
        try {
            Excel::import(new UsersImport, $request->file('file'));
        } catch (ValidationException $exception) {
            $failures = collect($exception->failures())
                ->map(fn ($failure): string => __('Baris :row: :errors', [
                    'row' => $failure->row(),
                    'errors' => implode(', ', $failure->errors()),
                ]))
                ->take(5)
                ->implode(' | ');

            return to_route('users.index')
                ->with('error', __('Gagal import Excel. :failures', ['failures' => $failures]));
        }

        return to_route('users.index')
            ->with('success', __('Data user berhasil diimport dari Excel.'));
    }
}
