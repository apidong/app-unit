<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.index', function ($view) {
            if (Auth::check()) {
                Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
                    $menu = Menu::with(['submenu.submenu'])
                        ->where('id_parent', 0)
                        ->where('active', 1)
                        ->get()
                        ->toArray();

                    $filteredData = aturMenu($menu);
                    foreach ($filteredData  as  $value) {
                        $event->menu->add($value);
                    }
                });
            }
        });
    }
}
