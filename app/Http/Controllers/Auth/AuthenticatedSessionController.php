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
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse //$request recives data from middleware(rolemiddleware)
    {
        $request->authenticate(); //now check it authenticate or not 

        $request->session()->regenerate(); //if authenticate save in session
        if($request->user()->role==='admin'){
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }

        return redirect()->intended(RouteServiceProvider::HOME); //if suceessful redirect RouteServiceProvider(home it send to dashboard)
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
