<?php

namespace App\Http\Controllers;

use App\Actions\SetTenantToShow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();



        $user->password = Hash::make($request->password);
        $user->first_access = 0; // Atualiza para false após a troca
        $user->save();

        $tenant = auth()->user()->tenants()->first();

        SetTenantToShow::run($tenant);



        return redirect()->route('calendar.index');
    }
}
