<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidationHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers->get('Accept') !== 'application/vnd.api+json') {
            return response()->json(['status'=>406,
                                     "title" =>"Not Acceptable",
                                     "datail"=>" Accept not correct in header"], 406);
        }
        return $next($request);
    }
}
