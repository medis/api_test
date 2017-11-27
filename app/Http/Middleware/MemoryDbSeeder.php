<?php

namespace App\Http\Middleware;

use Closure;

class MemoryDbSeeder
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
        \Illuminate\Support\Facades\Artisan::call('migrate:refresh', [
            '--seed'  => true,
            '--force' => true
        ]);
        return $next($request);
    }
}
