<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $req){
            
        $datos =  (object)$req->all();
         
         
         if ( Auth::attempt(['email' => $datos->email, 'password' => $datos->password ])){
                 $req->session()->regenerate();
                 $this->updateLastLoginDate();
                 $user->logAccess($req);
                 return redirect('dashboard');

         }

         return redirect()->route('login')->with(['errorLogin' => 'Datos de acceso incorrectos']);
    }
        
    public function logout(Request $req  ,  UserController $user){
            $user->logAccessOut($req);
            Auth::logout();
            return redirect('/login');
    }

    public static function updateLastLoginDate(){
            if (Auth::check()){
                    User::where('id', Auth::User()->id )->update(['lastaccess_at' =>now()]);
            }
    }

    public function getAvatar(){
        // return Auth::User()->getAvatar();
    }

}
