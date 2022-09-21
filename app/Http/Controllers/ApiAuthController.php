<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * check api auth class
 */
class ApiAuthController extends Controller
{
    /**
     * handle api user login function
     *
     * @param Request $request
     * @return void
     */
    public function hLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50|min:8',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $is_user = Auth::attempt([
            'email' =>  $request->email,
            'password' => $request->password
        ]);

        if (!$is_user) {
            return response()->json('wrong email or pass');
        }

        $user = User::where('email', '=', $request->email)->first();
        $new_access_token = Str::random(64);
        $user->update([
            'access_token' => $new_access_token,
        ]);
        return response()->json($user);
    }
    /**
     * handle api user logout function
     *
     * @param Request $request
     * @return void
     */
    public function hLogout(Request $request)
    {
        $access_token = $request->access_token;
        $user = User::where('access_token', '=', $access_token)->first();
        if ($user == null) {
            return response()->json('wrong token');
        }
        $user->update([
            'access_token' => null
        ]);
        return response()->json($user->access_token);
    }
}
