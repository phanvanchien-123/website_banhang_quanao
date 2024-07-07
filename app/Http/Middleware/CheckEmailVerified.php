<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the currently authenticated user
        $user = $request->user();

        // Check if the user is authenticated and their email is not verified
        // if ($user && !$user->hasVerifiedEmail()) {
        //     // Redirect to the email verification notice page
        //     return redirect('/email/verify');
        // }
        return $next($request);
    }
}
