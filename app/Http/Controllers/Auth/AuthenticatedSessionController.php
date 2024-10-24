<?php

namespace App\Http\Controllers\Auth;

use App\Actions\SetTenantToShow;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        if (auth()->user()->first_access == 1) {
            return redirect()->route('password.change'); // Rota para trocar a senha
        }

        $request->session()->regenerate();

        // if(auth()->user()->tenants()->count() > 1) {
        //     return redirect()->intended(RouteServiceProvider::HOME);
        // }

        // $tenant = auth()->user()->tenants->first();
        // session()->put('tenant_id', $tenant->id);
        // session()->put('tenant_name', $tenant->name);
        // session()->put('tenant_theme', $tenant->theme);

        // dd(auth()->user());




        $tenant = auth()->user()->tenants()->first();


        SetTenantToShow::run($tenant);



        return redirect()->route('calendar.index');

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
