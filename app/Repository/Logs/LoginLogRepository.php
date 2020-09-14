<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/8/17
 * Time: 5:39 PM
 */

namespace App\Repository\Logs;


use App\Models\UserLogTable;

class LoginLogRepository
{

    /**
     * @var UserLogTable
     */
    private $userLogTable;

    public function __construct(UserLogTable $userLogTable)
    {

        $this->userLogTable = $userLogTable;
    }

    public function getLoginLogs()
    {
        $logins = $this->userLogTable->orderBy('created_at','desc')->get();
        return $logins;
    }
}