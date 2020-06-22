<?php

namespace App\Listeners;

use App\Models\AdminMenu;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class BuildingUserMenus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(BuildingMenu $event)
    {
        $menu = new AdminMenu;
        $menus = $menu
            ->with('subMenus')
            ->where('parent_id', 0)
            ->orderBy('order')
            ->get();

        $active = function ($uri) {
            if ($uri) {
                $uri = url()->route($uri, [], false);
                return  ['regex:@^' . trim($uri, '/') . '/[0-9]+/.*$@'];
            }
            return '';
        };

        $func = function ($menus) use (&$func, $event, $active) {
            foreach ($menus as $menu) {
                $menu_info = [
                    'key' => $menu->id,
                    'text' => $menu->title,
                    'url' => $menu->uri ? (url()->isValidUrl($menu->uri) ? $menu->uri : route($menu->permission)) : '',
                    'icon' => 'nav-icon fas ' . $menu->icon,
                    'active' => $active($menu->permission),
                ];

                if ($menu->permission) {
                    $menu_info['can'] = $menu->permission;
                }

                if ($menu->parent) {
                    $event->menu->addin($menu->parent_id, $menu_info);
                } else {
                    $event->menu->add($menu_info);
                }

                if (count($menu->subMenus)) {
                    $func($menu->subMenus);
                }
            }
        };

        $func($menus);
    }
}
