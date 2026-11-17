<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'type' => Menu::TypeItem,
            'title' => fake()->words(2, true),
            'icon' => 'bi bi-grid-fill',
            'route_name' => null,
            'url' => '#',
            'route_pattern' => null,
            'order' => fake()->numberBetween(0, 100),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the menu is a section title.
     */
    public function title(): static
    {
        return $this->state(fn (): array => [
            'type' => Menu::TypeTitle,
            'icon' => null,
            'route_name' => null,
            'url' => null,
        ]);
    }
}
