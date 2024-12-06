<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Logincheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!$request->user()->isAdmin()) {
        //     return abort(404);
        //     //or redirect to somewhere
        // }
        // if (!session()->has("loggedInUser")  && ($request->path() != "/login")) {
        //     return redirect("/");
        //     // return response('Unauthorized.', 401);
        //     // echo"notauth";
        // }
        // if (session()->has("loggedInUser") && ($request->path() != "/") || ($request->path() != "/login")) {
        //     return back();
        // //     // echo"auth";
        // }
        return $next($request);
    }
}
