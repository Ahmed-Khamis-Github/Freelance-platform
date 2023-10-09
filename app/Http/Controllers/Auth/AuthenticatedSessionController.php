<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

     public $guard='web' ;
     public function __construct(Request $request)
     {
        if($request->is('admin/*')){
           $this->guard='admin'  ;
            
        }

     }
    public function create(): View
    {
        $routePrefix=$this->guard == 'admin'? 'admin.' :'' ;
        return view('auth.login',compact('routePrefix'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate($this->guard);

        $request->session()->regenerate();

        return redirect()->intended($this->guard=='admin'? RouteServiceProvider::DASHBOARD : RouteServiceProvider::HOME );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard($this->guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
