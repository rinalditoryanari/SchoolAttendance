<?php
namespace App\Http\Middleware;
use Closure;
class RedirectIfNotMahasiswa
{
    public function handle($request, Closure $next, $guard="mahasiswa")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('mahasiswa.login'));
        }
        return $next($request);
    }
}