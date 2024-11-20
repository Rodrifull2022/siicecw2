<?php

namespace App\Providers;
use App\Models\Menu;
use App\Models\Usuario;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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
    public function boot(Dispatcher $events): void
    {
        Paginator::useBootstrap();

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            //Usuario Logueado
            $iduser = Usuario::where('ACTIVO', -1)
            ->where('ID_SIICECW2',auth()->id())
            ->value('IDUSUARIO');

            if(is_null($iduser)){
                Redirect()->route('participantes.index');
            }

            // Obtener los menús usando el método estático del modelo
            $menus = Menu::getMenusForUser($iduser);

             // Inicializar los elementos del menú
            $items = [];

            // Iterar sobre cada menú principal para mapear sus submenús
            foreach ($menus as $menu) {
                // Obtener los submenús para el menú actual
                $subMenus = Menu::getSubMenus($iduser,$menu->IDMENU);

                $subItems = $subMenus->map(function ($subMenu) {
                    return [
                        'url' => $subMenu->URL_SM ? route($subMenu->URL_SM) : 0,
                        'text' => $subMenu->PARAMETRO2,
                        'icon' => $subMenu->ICON_SM
                    ];
                })->toArray();

                // Mapear los menús a los elementos del menú esperado por AdminLTE
                $items[] =[
                        'key' => $menu->IDMENU,
                        'text' => $menu->ENCABEZADO,
                        'icon' => 'fa-solid fa-angles-right',
                        'submenu' => $subItems,
                    ];
            }

            // Añadir los elementos al menú
            $event->menu->add(...$items);  // Desempaquetar el array

        });
    }
}
