<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/***
 * Class RedirectIfUserLogin
 * @package App\Http\Middleware
 */
class RedirectIfUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            return redirect(url('/'));
        }

        return $next($request);
    }
}
