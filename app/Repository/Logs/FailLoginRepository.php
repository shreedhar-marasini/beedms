<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/8/17
 * Time: 5:40 PM
 */

namespace App\Repository\Logs;


use App\Models\LoginFailLog;

class FailLoginRepository
{

    /**
     * @var LoginFailLog
     */
    private $failLog;

    public function __construct(LoginFailLog $failLog)
    {
        $this->failLog = $failLog;
    }

    public function getFailLoginLogs()
    {
        $failLogins = $this->failLog->orderBy('created_at','desc')->get();
        return $failLogins;
    }
}