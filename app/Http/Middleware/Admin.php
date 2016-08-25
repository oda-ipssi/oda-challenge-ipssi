<?php namespace App\Http\Middleware;

use Closure;
use Entrust;
use Auth;
use App;

class Admin {

    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        if (!Entrust::hasRole('role_admin') && Auth::check()) {
            return response()->json(trans('messages.forbidden'));
        }
        return $next($request);
    }

}
