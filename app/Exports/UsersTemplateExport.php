<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersTemplateExport implements FromArray, ShouldAutoSize, WithHeadings, WithStyles
{
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
            'password',
        ];
    }

    /**
     * Provide sample rows for the import template.
     *
     * @return list<list<mixed>>
     */
    public function array(): array
    {
        return [
            [
                'John Doe',
                'john@example.com',
                'admin',
                'password',
            ],
            [
                'Jane Smith',
                'jane@example.com',
                'user',
                'password',
            ],
        ];
    }

    /**
     * Style the header row.
     *
     * @return array<int|string, array<string, mixed>>
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
