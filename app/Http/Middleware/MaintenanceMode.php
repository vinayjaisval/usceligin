<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class MaintenanceMode
{
    public function handle($request, Closure $next)

    {

        $gs = cache()->remember('generalsettings', now()->addDay(), function () {
            return DB::table('generalsettings')->first();
        });

        if ($gs && $gs->is_maintain == 1) {
            return redirect()->route('front-maintenance');
        }


        return $next($request);
    }
}
