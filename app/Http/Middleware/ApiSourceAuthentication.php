<?php

namespace App\Http\Middleware;

use App\Models\ApiSourceCredential;
use Closure;

class ApiSourceAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $clientId = request()->header('client-id') ?? request()->header('user-id');
        $clientSecret = request()->header('client-secret') ?? request()->header('password');

        $credential = ApiSourceCredential::select('SourceId')->where([
            'ClientId' => $clientId,
            'ClientSecret' => $clientSecret,
            'StatusId' => 1
        ])->first();
        if (!$credential)
            return response('Un Authorize', 401);
        else {
        return $next($request);
        }
    }
}
