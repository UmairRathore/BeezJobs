<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UpdateUserOnlineStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Check if the user is authenticated
        if (Auth::guard('user')->check()) {
            // Get the authenticated user
            $user = Auth::guard('user')->user();

            // Update the online status based on user's login status
            $user->update(['online_status' => Auth::guard('user')->viaRemember() ? 'online' : 'offline']);
        }

        return $response;

    }
}
