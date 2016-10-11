<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username() {
        return 'username';
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user) {
        $newSessid = Session::getId(); //get new session_id after user sign in
        if ($user->last_session_id) {
            $lastSession = Session::getHandler()->read($user->last_session_id); // retrive last session

            if ($lastSession) {
                if (\Session::getHandler()->destroy($user->last_session_id)) {
                    // session was destroyed
                }
            }
        }

        $user->last_session_id = $newSessid;
        $user->save();
    }

}
