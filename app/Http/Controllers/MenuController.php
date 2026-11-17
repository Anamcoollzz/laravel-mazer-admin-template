<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    /**
     * Display a listing of the menus.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->value();
        $type = $request->string('type')->trim()->value();

        $menus = Menu::query()
            ->with(['parent:id,title'])
            ->withCount('children')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($q) use ($search): void {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('route_name', 'like', "%{$search}%")
                        ->orWhere('url', 'like', "%{$search}%")
                        ->orWhere('permission_name', 'like', "%{$search}%");
                });
            })
            ->when($type !== '', fn ($query) => $query->where('type', $type))
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN 0 ELSE 1 END')
            ->orderBy('parent_id')
            ->orderBy('order')
            ->orderBy('id')
            ->paginate(20)
            ->withQueryString();

        return view('menus.index', [
            'menus' => $menus,
            'search' => $search,
            'type' => $type,
        ]);
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create(): View
    {
        return view('menus.create', [
            'menu' => new Menu(['type' => Menu::TypeItem, 'order' => 0, 'is_active' => true]),
            'parentOptions' => $this->parentOptions(),
            'permissions' => Permission::query()->orderBy('name')->pluck('name'),
        ]);
    }

    /**
     * Store a newly created menu in storage.
     */
    public function store(StoreMenuRequest $request): RedirectResponse
    {
        Menu::query()->create($request->validated());

        return to_route('menus.index')
            ->with('success', __('Menu berhasil ditambahkan.'));
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Menu $menu): View
    {
        return view('menus.edit', [
            'menu' => $menu,
            'parentOptions' => $this->parentOptions($menu->id),
            'permissions' => Permission::query()->orderBy('name')->pluck('name'),
        ]);
    }

    /**
     * Update the specified menu in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->validated());

        return to_route('menus.index')
            ->with('success', __('Menu berhasil diperbarui.'));
    }

    /**
     * Remove the specified menu from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();

        return to_route('menus.index')
            ->with('success', __('Menu berhasil dihapus.'));
    }

    /**
     * Get selectable parent menu items.
     *
     * @return Collection<int, Menu>
     */
    private function parentOptions(?int $excludeId = null)
    {
        return Menu::query()
            ->where('type', Menu::TypeItem)
            ->when($excludeId !== null, fn ($query) => $query->whereKeyNot($excludeId))
            ->with('parent:id,title')
            ->orderBy('order')
            ->orderBy('title')
            ->get(['id', 'parent_id', 'title']);
    }
}
