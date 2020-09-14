<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles']);
    }

}
