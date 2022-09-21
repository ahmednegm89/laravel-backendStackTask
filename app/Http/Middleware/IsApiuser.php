<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class IsApiuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    /**
     * check access token function
     *
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('access_token')) {
            if ($request->access_token !== null) {
                $user = User::where('access_token', '=', $request->access_token)->first();
                if ($user !== null) {
                    return $next($request);
                } else {
                    return response()->json('no user with this token');
                }
            } else {
                return response()->json('token ERROR');
            }
        } else {
            return response()->json('error with access token not included');
        }
    }
}
