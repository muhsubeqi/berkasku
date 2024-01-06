<?php

namespace App\Http\Middleware;

use App\Http\Services\Auth;
use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        try {
            //code...
            $user = Auth::user();
            $roleUser = $user->level->level;
            foreach ($roles as $role) {
                if ($roleUser == $role) {
                    return $next($request);
                }
            }
            return redirect()->route('root');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('root');
        }
    }
}
