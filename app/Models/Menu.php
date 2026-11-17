<?php

namespace App\Models;

use Database\Factories\MenuFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Route;

#[Fillable([
    'parent_id',
    'type',
    'title',
    'icon',
    'route_name',
    'url',
    'route_pattern',
    'order',
    'is_active',
])]
class Menu extends Model
{
    /** @use HasFactory<MenuFactory> */
    use HasFactory;

    public const string TypeTitle = 'title';

    public const string TypeItem = 'item';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the parent menu item.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Get the child menu items ordered by position.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order')->orderBy('id');
    }

    /**
     * Scope a query to only include active menu items.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include root-level menu items.
     */
    public function scopeRoots(Builder $query): Builder
    {
        return $query->whereNull('parent_id')->orderBy('order')->orderBy('id');
    }

    /**
     * Determine whether this menu item is a section title.
     */
    public function isTitle(): bool
    {
        return $this->type === self::TypeTitle;
    }

    /**
     * Resolve the href URL for this menu item.
     */
    public function resolvedHref(): string
    {
        if ($this->route_name && Route::has($this->route_name)) {
            return route($this->route_name);
        }

        if ($this->url) {
            return $this->url;
        }

        return '#';
    }

    /**
     * Determine whether this menu item or any of its descendants is currently active.
     */
    public function isCurrentlyActive(): bool
    {
        if ($this->route_pattern) {
            $patterns = array_map('trim', explode(',', $this->route_pattern));
            if (request()->routeIs($patterns)) {
                return true;
            }
        }

        if ($this->route_name && request()->routeIs($this->route_name)) {
            return true;
        }

        if ($this->relationLoaded('children')) {
            return $this->children->contains(fn (self $child): bool => $child->isCurrentlyActive());
        }

        return false;
    }
}
