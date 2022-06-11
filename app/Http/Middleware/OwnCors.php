<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnCors
{

    public function handle(Request $request, Closure $next)
    {
      return $next($request)
          ->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS ,FETCH')
          ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
          ->header('Access-Control-Allow-Credentials',' true');
    }

}
