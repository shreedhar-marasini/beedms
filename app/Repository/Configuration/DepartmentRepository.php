<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/1/17
 * Time: 2:08 PM
 */

namespace App\Repository\Configuration;


use App\Models\Department;

class DepartmentRepository
{
    private $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function all()
    {
        $departments = $this->department->orderBy('department_name','asc')->get();
        return $departments;
    }

    public function findById($id)
    {
        $department = $this->department->find($id);
        return $department;
    }
    public function lists()
    {
        return $this->department
            ->select('id','department_name')
            ->orderBy('department_name', 'asc')
            ->get();
    }
}