<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Traits\RestTrait;

class Authenticate extends Middleware
{
    use RestTrait;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson() && !$this->isApiCall($request)) {
            return route('/login');
        }

//        return $this->jsonResponse([
//                                       'status' => 'error',
//                                       'message' => 'Unauthenticated',
//                                       'error' => 'Unauthenticated.'
//                                   ], 401);
    }
}
