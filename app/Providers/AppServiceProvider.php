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

            $event->menu->add('MENU DE NAVEGAÇÃO');

            $menu = new AdminMenu;
            $menus = $menu->with('subMenus')->get();

            foreach($menus as $menu){

                $arrayMenu = array('text' => '', 'url' => '', 'icon' => '', 'can' => '');

                if(count($menu->subMenus) != NULL){
                    foreach($menu->subMenus as $submenu){
                        $arrayMenu[] = array(
                            'text' => $submenu->name,
                            'url' => $submenu->uri,
                            'icon' => $submenu->icon
                        );

                    };
                    $event->menu->add([
                        'text' => $menu->name,
                        'url' => $menu->uri,
                        'icon' => $menu->icon,
                        'submenu' => $arrayMenu,
                    ]);
                }else{
                    $event->menu->add([
                        'text' => $menu->name,
                        'url' => $menu->uri,
                        'icon' => $menu->icon,
                    ]);
                }
            }
        });
    }
}
