<?php

namespace App\Http\Controllers;


use App\Repository\Logs\FailLoginRepository;
use App\Repository\Logs\LoginLogRepository;
use Illuminate\Http\Request;

class LoginLogController extends BaseController
{

    /**
     * @var LoginLogRepository
     */
    private $loginLogRepository;
    /**
     * @var FailLoginRepository
     */
    private $failLoginRepository;

    public function __construct(LoginLogRepository $loginLogRepository, FailLoginRepository $failLoginRepository)
    {
        parent::__construct();
        $this->loginLogRepository = $loginLogRepository;
        $this->failLoginRepository = $failLoginRepository;
    }


    public function index()
    {
        $logins = $this->loginLogRepository->getLoginLogs();
        return view('logs.login', compact('logins'));
    }

    public function failLogin()
    {
        $failLogins = $this->failLoginRepository->getFailLoginLogs();
        return view('logs.failLogin', compact('failLogins'));
    }


}
