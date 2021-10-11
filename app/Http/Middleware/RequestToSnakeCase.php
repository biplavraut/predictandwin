<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestToSnakeCase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $replaced = [];
        foreach ($request->all() as $key => $value) {
            if (!Str::snake($key)) {
                $replaced[Str::snake($key)] = $value;
            }
        }
        $request->replace($replaced);

        return $next($request);
    }
}
