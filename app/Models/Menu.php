<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'MENU';
    protected $primaryKey = 'IDMENU';
    public $incrementing = false;
    public $timestamps = false;

    public static function getMenusForUser($idUser)
    {
        return DB::table('dbo.MENU')
            ->distinct()
            ->select('dbo.MENU.IDMENU', 'dbo.MENU.ENCABEZADO')
            ->join('dbo.OPCION', 'dbo.MENU.IDMENU', '=', 'dbo.OPCION.IDMENU')
            ->join('dbo.USUARIO_OPCION', 'dbo.OPCION.IDOPCION', '=', 'dbo.USUARIO_OPCION.IDOPCION')
            ->join('dbo.USUARIO', 'dbo.USUARIO_OPCION.IDUSUARIO', '=', 'dbo.USUARIO.IDUSUARIO')
            ->where('USUARIO.IDUSUARIO', $idUser)
            ->where('dbo.MENU.NIVEL_PADRE', 0)
            ->orderBy('dbo.MENU.IDMENU')
            ->get();
    }

    public static function getSubMenus($userId, $menuId)
    {
        return DB::table('dbo.MENU')
            ->join('dbo.OPCION', 'dbo.MENU.IDMENU', '=', 'dbo.OPCION.IDMENU')
            ->join('dbo.USUARIO_OPCION', 'dbo.OPCION.IDOPCION', '=', 'dbo.USUARIO_OPCION.IDOPCION')
            ->join('dbo.USUARIO', 'dbo.USUARIO_OPCION.IDUSUARIO', '=', 'dbo.USUARIO.IDUSUARIO')
            ->join('dbo.INTERFAZ', 'dbo.INTERFAZ.IDINTERFAZ', '=', 'dbo.OPCION.IDINTERFAZ')
            ->select(
                'dbo.USUARIO.IDUSUARIO',
                'dbo.OPCION.PARAMETRO1',
                'dbo.OPCION.PARAMETRO2',
                'dbo.USUARIO.NOMBRE',
                'dbo.MENU.ENCABEZADO',
                'dbo.MENU.IDMENU',
                'dbo.MENU.NIVEL_PADRE',
                'dbo.OPCION.ICON_SM',
                'dbo.OPCION.URL_SM'
            )
            ->where('dbo.USUARIO.IDUSUARIO', $userId)
            ->where('dbo.MENU.IDMENU', $menuId)
            ->orderBy('dbo.MENU.IDMENU')
            ->distinct()
            ->get();
    }
}
