<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\BaseController;
use App\Models\UserRole;
use App\Repository\Roles\GroupRepository;
use App\Repository\Roles\MenuRepository;
use App\Repository\Roles\UserRoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleAccessController extends BaseController
{
    /**
     * @var GroupRepository
     */
    private $groupRepository;
    /**
     * @var UserRole
     */
    private $userRole;
    /**
     * @var MenuRepository
     */
    private $menuRepository;
    /**
     * @var UserRoleRepository
     */
    private $userRoleRepository;

    public function __construct(GroupRepository $groupRepository,
                                MenuRepository $menuRepository,
                                UserRole $userRole,
                                UserRoleRepository $userRoleRepository)
    {
        parent::__construct();
        $this->groupRepository = $groupRepository;
        $this->userRole = $userRole;
        $this->menuRepository = $menuRepository;
        $this->userRoleRepository = $userRoleRepository;
    }
    //
    public function index(Request $request){
//        return $request->all();

        $groupList=$this->groupRepository->groupList();
        if ($request->has('group_id')) {
            $group_id = $request->get('group_id');
        } else {
            $group_id = 0;
        }

        if ($request->has('group_id')) {
            $menus = $this->menuRepository->getAccessMenu(0, $group_id);
        } else {
            $menus = 0;
        }
        $this->userRoleRepository->copyMenu($group_id);
        $menuRepo= $this->menuRepository;
        return view('roles.roleAccess',compact('menus','groupList','menuRepo'));
    }

    public function changeAccess($allowId, $id)
    {
        $this->userRoleRepository->changePermission($allowId, $id);
    }
}
