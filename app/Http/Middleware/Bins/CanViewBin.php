<?php

namespace App\Http\Middleware\Bins;

use App\LaraBin\Models\Bins\Bin;
use Closure;

class CanViewBin
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

        if (!$bin) {
            session()->flash('error', 'Sorry, we could not find a bin at that url!');

            return redirect()->route('home');
        }

        if ($bin->isPrivate()) {
            if (!static::canViewPrivateBin($bin)) {
                session()->flash('error', 'You do not have permission to view this bin!');

                return redirect()->route('home');
            }
        }

        return $next($request);
    }

    private static function canViewPrivateBin(Bin $bin)
    {
        // Check if user is admin
        if (auth()->check() && auth()->user()->admin()) {
            return true;
        }

        // Check if user is bin owner
        if (auth()->check() && auth()->user()->getAuthIdentifier() == $bin->user_id) {
            return true;
        }

        return false;
    }
}
