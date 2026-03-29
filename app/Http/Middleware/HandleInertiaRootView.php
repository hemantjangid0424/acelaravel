<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HandleInertiaRootView
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('admin') || $request->is('admin/*')) {
            Inertia::setRootView('app');
        } else {
            Inertia::setRootView('frontend');
        }
        return $next($request);
    }
}