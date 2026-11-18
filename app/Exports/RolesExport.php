<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Spatie\Permission\Models\Role;

/**
 * @implements WithMapping<Role>
 */
class RolesExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct(
        private readonly string $search = '',
    ) {}

    /**
     * Build the query for exporting roles.
     */
    public function query(): Builder
    {
        return Role::query()
            ->with('permissions:id,name')
            ->withCount('users')
            ->when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', "%{$this->search}%"))
            ->orderBy('name');
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
            'guard_name',
            'users_count',
            'permissions',
            'created_at',
        ];
    }

    /**
     * Map a Role model to an export row.
     *
     * @param  Role  $role
     * @return list<mixed>
     */
    public function map($role): array
    {
        return [
            $role->name,
            $role->guard_name,
            (int) $role->users_count,
            $role->permissions->pluck('name')->implode(', '),
            $role->created_at?->format('Y-m-d H:i:s') ?? '',
        ];
    }
}
