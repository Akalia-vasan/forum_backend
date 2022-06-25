<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
class VerifyEmail
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
        
        if( ! is_null($request->user() ) && is_null( $request->user()->email_verified_at) && !Str::contains($request->url(),'email') ){
            return redirect()->to('/email/verify');
        }
        return $next($request);
    }
}
