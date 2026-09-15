<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('admin_id')) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Please sign in to access the admin portal.');
        }

        return $next($request);
    }
}
