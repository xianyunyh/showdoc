<?php

namespace app\http\middleware;

class Api
{
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}
