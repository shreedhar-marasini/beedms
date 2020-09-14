<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 7/27/17
 * Time: 4:21 PM
 */

namespace App\Repository;


use App\Models\Skin;

class SkinRepository
{
    /**
     * @var Skin
     */
    private $skin;

    /**
     * @var User
     */
  

    public function __construct( Skin $skin)
    {


        $this->skin = $skin;
    }

    public function all(){
        $skins=$this->skin->all();
        return $skins;

    }

    public function skinList(){
        $skins=$this->skin
            ->select('id','skin_name')
            ->orderBy('skin_name','asc')
            ->get();
        return $skins;
    }

    public function findById($id){
        $skin=$this->skin->find($id);
        return $skin;
    }

}