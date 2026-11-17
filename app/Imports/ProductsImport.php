<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements SkipsEmptyRows, ToModel, WithHeadingRow, WithUpserts, WithValidation
{
    /**
     * Map an imported Excel row to a Product model.
     *
     * @param  array<string, mixed>  $row
     */
    public function model(array $row): Product
    {
        return new Product([
            'sku' => trim((string) $row['sku']),
            'name' => trim((string) $row['name']),
            'category' => isset($row['category']) && $row['category'] !== '' ? trim((string) $row['category']) : null,
            'price' => (float) ($row['price'] ?? 0),
            'stock' => (int) ($row['stock'] ?? 0),
            'description' => isset($row['description']) && $row['description'] !== '' ? (string) $row['description'] : null,
            'is_active' => $this->parseActive($row['is_active'] ?? true),
        ]);
    }

    /**
     * Upsert products by SKU.
     */
    public function uniqueBy(): string
    {
        return 'sku';
    }

    /**
     * Validation rules for each imported row.
     *
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'sku' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * Parse flexible active status values from spreadsheet cells.
     */
    private function parseActive(mixed $value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        $normalized = strtolower(trim((string) $value));

        return ! in_array($normalized, ['0', 'false', 'no', 'inactive', 'nonaktif'], true);
    }
}
