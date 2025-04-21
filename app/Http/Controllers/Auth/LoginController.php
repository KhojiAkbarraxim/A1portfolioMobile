<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        if (Auth::user()->role_id == 1) {
            return route('itb.home');
        }
        elseif (Auth::user()->role_id == 2) {
            return route('ilmiy.home');
        }
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->role_id == 1) {
                echo "baaa";
                return redirect()->route('itb.home')->with('success', 'Iqtidorli talabalar bo\'limiga xush kelibsiz!');
            }
            if(auth()->user()->role_id == 2) {
                return redirect()->route('ilmiy.home')->with('success', 'Ilmiy rahbar bo\'limiga xush kelibsiz!');
            }
            if(auth()->user()->role_id == 3) {
                return redirect()->route('student.home')->with('success', 'Talaba bo\'limiga xush kelibsiz!');
            }
        }
        else{
            return redirect()->route('login')
                ->with('delete','Login yoki parol xato!');
        }
    }
}
