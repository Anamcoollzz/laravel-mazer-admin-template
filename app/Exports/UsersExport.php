<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * @implements WithMapping<User>
 */
class UsersExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct(
        private readonly string $search = '',
        private readonly string $role = '',
    ) {}

    /**
     * Build the query for exporting users.
     */
    public function query(): Builder
    {
        return User::query()
            ->with('roles:id,name')
            ->when($this->search !== '', function (Builder $query): void {
                $query->where(function (Builder $q): void {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->when($this->role !== '', fn (Builder $query) => $query->role($this->role))
            ->orderBy('id');
    }

    /**
     * Define the Excel column headings.
     *
     * @return list<string>
     */
    public function headings(): array
    {
        return [
            'name',
            'email',
            'roles',
            'last_logged_in',
            'created_at',
        ];
    }

    /**
     * Map a User model to an export row.
     *
     * @param  User  $user
     * @return list<mixed>
     */
    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->roles->pluck('name')->implode(', '),
            $user->last_logged_in?->format('Y-m-d H:i:s') ?? '',
            $user->created_at?->format('Y-m-d H:i:s') ?? '',
        ];
    }
}
