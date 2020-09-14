<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/1/17
 * Time: 3:07 PM
 */

namespace App\Repository\Configuration;


use App\Models\Designation;

class DesignationRepository
{
    private $designation;

    public function __construct(Designation $designation)
    {
        $this->designation = $designation;
    }

    public function all()
    {
        $designation = $this->designation->orderBy('designation_name','Asc')->get();
        return $designation;
    }
    public function findById($id)
    {
        $designation = $this->designation->find($id);
        return $designation;
    }
}