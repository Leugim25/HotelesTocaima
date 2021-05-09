<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated()
    {
        if (Auth::check() && auth()->user()->is_admin == 1) {
            DB::table('auditorias')->insert([
                'description' => 'El usuario'." ".'ha iniciado sesión',
                'user_name' => 'Acción realizada por' . " " ." - " .auth()->user()->name,
                'created_at'=>Carbon::now(),
            ]);
            return redirect()->route('hoteles.index');
        } elseif (Auth::check() && auth()->user()->is_admin == 0) {
            DB::table('auditorias')->insert([
                'description' => 'El usuario'." ".'ha iniciado sesión',
                'user_name' => 'Acción realizada por' . " " ." - " .auth()->user()->name,
                'created_at'=>Carbon::now(),
            ]);
            return redirect()->route('inicio.index');
        } else {
            return redirect()->route('inicio.index');
        }
    }
}
