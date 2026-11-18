<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Spatie\Permission\Models\Role;

class UsersImport implements SkipsEmptyRows, ToCollection, WithHeadingRow, WithValidation
{
    /**
     * Import each validated spreadsheet row into users and sync roles.
     *
     * @param  Collection<int, Collection<string, mixed>>  $rows
     */
    public function collection(Collection $rows): void
    {
        $availableRoles = Role::query()->pluck('name')->all();

        foreach ($rows as $row) {
            $email = strtolower(trim((string) $row['email']));
            $name = trim((string) $row['name']);
            $password = isset($row['password']) && trim((string) $row['password']) !== ''
                ? (string) $row['password']
                : null;

            $user = User::query()->where('email', $email)->first();

            if ($user) {
                $attributes = ['name' => $name];

                if ($password !== null) {
                    $attributes['password'] = $password;
                }

                $user->update($attributes);
            } else {
                $user = User::query()->create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password ?? 'password',
                    'email_verified_at' => now(),
                ]);
            }

            if (array_key_exists('roles', $row->toArray())) {
                $requestedRoles = collect(explode(',', (string) ($row['roles'] ?? '')))
                    ->map(fn (string $role): string => trim($role))
                    ->filter(fn (string $role): bool => $role !== '' && in_array($role, $availableRoles, true))
                    ->values()
                    ->all();

                $user->syncRoles($requestedRoles);
            }
        }
    }

    /**
     * Validation rules for each imported row.
     *
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'roles' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:6'],
        ];
    }
}
