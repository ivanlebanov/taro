<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $user = \Auth::user();
      if (!$user ||  $user['attributes']['is_admin'] != 1 ) {
          return redirect(route('404'));
      }
        return $next($request);
    }
}
