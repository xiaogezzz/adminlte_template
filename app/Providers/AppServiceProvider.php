<?php

namespace App\Providers;

use App\Models\AdminMenu;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    public function boot(Dispatcher $events)
    {
        //监听菜单构造事件、构造用户权限菜单
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $menu = new AdminMenu;
            $menus = $menu
                ->with('subMenus')
                ->where('parent_id', 0)
                ->orderBy('order')
                ->get();

            $active = function ($uri) {
                if ($uri) {
                    $uri = url()->route($uri, [], false);
                    return  ['regex:@^' . substr($uri, 1) . '/[0-9]+/.*$@'];
                }
                return '';
            };

            $func = function ($menus) use (&$func, $event, $active) {
                foreach ($menus as $menu) {
                    $event->menu->addin($menu->parent_id, [
                        'text' => $menu->title,
                        'url' => $menu->permission ? route($menu->permission) : '',
                        'icon' => 'nav-icon fas ' . $menu->icon,
                        'active' => $active($menu->permission),
                    ]);

                    if (count($menu->subMenus)) {
                        $func($menu->subMenus);
                    }
                }
            };

            foreach ($menus as $menu) {
                $event->menu->add([
                    'key' => $menu->id,
                    'text' => $menu->title,
                    'url' => $menu->permission ? route($menu->permission) : '',
                    'icon' => $menu->icon,
                    'active' => $active($menu->permission),
                ]);

                if (count($menu->subMenus)) {
                    $func($menu->subMenus);
                }
            }
        });
    }
}
