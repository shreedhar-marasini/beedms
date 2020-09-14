<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginFailLog;
use App\Models\UserLogTable;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |---------------------------------------we-----------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * @param Request $request
     * @return LoginController|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|mixed
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $remember_me = $request->has('remember') ? true : false;
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {

        }
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['user_status' => 'active']);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $now = Carbon::now();
        $ip = \Request::ip();
        $agent = $request->header('User-Agent');
        UserLogTable::create(['user_id' => Auth::user()->id, 'log_in_ip' => $ip, 'log_in_device' => $agent, 'log_in_date' => $now]);

        $session = $now->addMinute(5);

        DB::table('users')->where(['id' => Auth::user()->id])->update(['last_online' => $session]);
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }


    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();

        $ip = \Request::ip();
        $agent = $request->header('User-Agent');

        LoginFailLog::create(['user_name' => $request->get('email'), 'fail_password' => $request->get('password'), 'log_in_ip' => $ip, 'log_in_device' => $agent]);

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->user_status != 'active') {
            $errors = [$this->username() => trans('auth.notActivated')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    public function logout(Request $request)
    {
        DB::table('users')->where(['id' => Auth::user()->id])->update(['last_online' => Carbon::now()]);

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function showLoginForm()
    {
        $logo = DB::table('master_settings')->where('key_name', '=', '_COMPANY_LOGO_')->first();
        $logo = $logo->key_value;
        return view('auth.login', compact('logo'));
    }

}
