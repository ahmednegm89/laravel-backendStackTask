<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Auth class
 */
class AuthController extends Controller
{
    /**
     * return login view function
     *
     * @return void
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * handel login function
     *
     * @param Request $request
     * @return void
     */
    public function hLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50|min:8'
        ]);

        $is_login = Auth::attempt([
            'email' =>  $request->email,
            'password' => $request->password
        ]);

        if (!$is_login) {
            return back();
        }

        return redirect(route('projects.index'));
    }
    /**
     * handle logout function
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();
        return back();
    }
}
