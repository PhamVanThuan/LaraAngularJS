<?php
/**
 * Created by PhpStorm.
 * Users: phamt
 * Date: 8/7/2016
 * Time: 10:30 AM
 */

namespace App\TP\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $permission = str_replace(['api::', 'admin::'], '', $request->route()->getName());
        if ($request->user()->cannot($permission)) {
            abort(403);
        }

        return $next($request);
    }
}
