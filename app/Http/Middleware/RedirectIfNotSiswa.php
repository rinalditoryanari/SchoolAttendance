<?php
namespace App\Http\Middleware;
use Closure;
class RedirectIfNotSiswa
{
    public function handle($request, Closure $next, $guard="siswa")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('siswa.login'));
        }
        return $next($request);
    }
}