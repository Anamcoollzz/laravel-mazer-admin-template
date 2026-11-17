<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsTemplateExport implements FromArray, ShouldAutoSize, WithHeadings, WithStyles
{
    /**
     * Define the Excel column headings.
     *
     * @return list<string>
     */
    public function headings(): array
    {
        return [
            'sku',
            'name',
            'category',
            'price',
            'stock',
            'description',
            'is_active',
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
                'PRD-1001',
                'Wireless Mouse',
                'Electronics',
                150000,
                25,
                'Mouse wireless ergonomis 2.4GHz',
                1,
            ],
            [
                'PRD-1002',
                'Mechanical Keyboard',
                'Electronics',
                550000,
                10,
                'Keyboard mechanical compact 75%',
                1,
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
