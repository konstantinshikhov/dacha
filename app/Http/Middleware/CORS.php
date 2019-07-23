<?php

namespace App\Http\Middleware;

use Closure;

class CORS
{
    public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin' => isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*',
            'Access-Control-Allow-Methods' => 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age' => '86400',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With',
        ];

        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);

        if ($request->segment(1) == 'api') {
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }
        }

        return $response;
    }
}