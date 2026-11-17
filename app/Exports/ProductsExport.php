<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * @implements WithMapping<Product>
 */
class ProductsExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
     * Build the query for exporting products.
     */
    public function query(): Builder
    {
        return Product::query()->orderBy('id');
    }

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
     * Map a Product model to an export row.
     *
     * @param  Product  $product
     * @return list<mixed>
     */
    public function map($product): array
    {
        return [
            $product->sku,
            $product->name,
            $product->category,
            (float) $product->price,
            $product->stock,
            $product->description,
            $product->is_active ? 1 : 0,
        ];
    }
}
