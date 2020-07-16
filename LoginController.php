<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:6'],
      ]);
  }


    use AuthenticatesUsers;

     protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo(){

        if(Auth::check() && Auth::user()->role_id <= 2){
          $this->redirectTo = route('admin.index');
           return $this->redirectTo;
        }else if(Auth::check() && Auth::user()->role_id == 3){
          $this->redirectTo = route('customer.dashboard');
           return $this->redirectTo;
        }
    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
