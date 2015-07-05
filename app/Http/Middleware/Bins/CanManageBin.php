<?php

namespace App\Http\Middleware\Bins;

use App\LaraBin\Models\Bins\Bin;
use Closure;

class CanManageBin
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
        $bin = $request->route('bin');

        if (!static::canManageBin($bin)) {
            session()->flash('error', 'You do not have permission to manage this bin!');

            return redirect()->route('bin.code', $bin->getRouteKey());
        }

        return $next($request);
    }

    private static function canManageBin(Bin $bin)
    {
        // Check if user is admin
        if (auth()->user()->admin()) {
            return true;
        }

        // Check if user is bin owner
        if (auth()->user()->getAuthIdentifier() == $bin->user_id) {
            return true;
        }

        return false;
    }
}
