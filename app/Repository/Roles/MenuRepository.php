<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 7/25/17
 * Time: 5:45 PM
 */

namespace App\Repository\Roles;


use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuRepository
{
    /**
     * @var Menu
     */
    private $menu;

    public function __construct(Menu $menu)
    {

        $this->menu = $menu;
    }

    public function all(){
        $menus=$this->menu->all();
        return $menus;
    }

    public function parentList($selectedId = 0){
        $menus=$this->menu
            ->select('id','menu_name')
            ->where('parent_id','=','0')
            ->orderBy('menu_name','ASC')
            ->get();
        $list = '';
        foreach ($menus as $menu) {
            $select = ($selectedId == $menu->id) ? 'selected' : null;
            $list .= "<option value = " . $menu->id . " style='font-weight:bolder;' " . $select . ">" . $menu->menu_name . "</option>";
            $levelOne = $this->menu
                ->select('menu_name', 'id')
                ->where('parent_id', '=', $menu->id)
                ->orderBy('menu_name', 'ASC')
                ->get();
            foreach ($levelOne as $one) {
                $levelOneSelect = ($selectedId == $one->id) ? 'selected' : null;
                $list .= "<option value=" . $one->id . " " . $levelOneSelect . "> &emsp;" . $one->menu_name . "</option>";
            }
        }

        echo $list;
    }

    public function findById($id){
        $menu=$this->menu->find($id);
        return $menu;
    }

    public function getAccessMenu($id, $group_id)
    {
        $result = DB::table('menus')
            ->join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
            ->where('parent_id', $id)
            ->where('menu_status', 1)
            ->where('user_group_id', $group_id)
            ->select(
                'user_roles.id as group_role_id',
                'user_group_id',
                'menu_id',
                'allow_view',
                'allow_add',
                'allow_edit',
                'allow_delete',
                'menus.*'
            )
            ->orderBy('menu_order', 'ASC')
            ->get();
        return  $result ;
    }

}