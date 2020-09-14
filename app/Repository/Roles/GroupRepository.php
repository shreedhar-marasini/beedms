<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 7/27/17
 * Time: 12:39 PM
 */

namespace App\Repository\Roles;


use App\Models\UserGroup;

class GroupRepository
{

    /**
     * @var UserGroup
     */
    private $userGroup;

    public function __construct(UserGroup $userGroup)
    {

        $this->userGroup = $userGroup;
    }

    public function all(){
        $groups=$this->userGroup->all();
        return $groups;

    }

    public function groupList(){
        $groups=$this->userGroup
            ->select('id','group_name')
            ->orderBy('id','DESC')
            ->get();
        return $groups;
    }

    public function findById($id){
        $group=$this->userGroup->find($id);
        return $group;
    }
}