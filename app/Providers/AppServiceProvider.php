<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('mazer.layouts.app-mazer', function ($view): void {
            $sidebarMenus = Schema::hasTable('menus')
                ? Menu::query()
                    ->active()
                    ->roots()
                    ->with([
                        'children' => fn ($query) => $query
                            ->active()
                            ->with([
                                'children' => fn ($subQuery) => $subQuery->active(),
                            ]),
                    ])
                    ->get()
                : collect();

            $view->with('sidebarMenus', $sidebarMenus);
        });
    }
}
