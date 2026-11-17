<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed sample products and add the Products menu item.
     */
    public function run(): void
    {
        if (Product::query()->doesntExist()) {
            Product::factory()->count(15)->create();
        }

        Menu::query()->updateOrCreate(
            ['route_name' => 'products.index', 'parent_id' => null],
            [
                'type' => Menu::TypeItem,
                'title' => 'Produk',
                'title_en' => 'Products',
                'icon' => 'bi bi-box-seam-fill',
                'route_pattern' => 'products.*',
                'order' => 5,
                'is_active' => true,
            ],
        );
    }
}
