<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'sku',
    'name',
    'category',
    'price',
    'stock',
    'description',
    'is_active',
])]
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Duplicate this product with a unique SKU and "(Copy)" suffix.
     */
    public function duplicate(): self
    {
        $copy = $this->replicate();
        $copy->name = "{$this->name} (Copy)";
        $copy->sku = $this->generateUniqueCopySku();
        $copy->save();

        return $copy;
    }

    /**
     * Generate a unique SKU for a duplicated product.
     */
    private function generateUniqueCopySku(): string
    {
        $base = "{$this->sku}-COPY";
        $candidate = $base;
        $counter = 2;

        while (self::query()->where('sku', $candidate)->exists()) {
            $candidate = "{$base}-{$counter}";
            $counter++;
        }

        return $candidate;
    }
}
