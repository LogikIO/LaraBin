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
            if (!static::canViewPrivateBin($bin, $request)) {
                session()->flash('error', 'You do not have permission to view this bin!');

                return redirect()->route('home');
            }
        }

        return $next($request);
    }

    private static function canViewPrivateBin(Bin $bin, $request)
    {
        // Check if user is admin
        if (auth()->check() && auth()->user()->admin()) {
            return true;
        }

        // Check if user is bin owner
        if (auth()->check() && auth()->user()->getAuthIdentifier() == $bin->user_id) {
            return true;
        }

        if ($bin->isShared()) {
            if (session()->get('private-' . $bin->getRouteKey()) == $bin->private_hash) {
                return true;
            }

            // Check if user has a hash key for bin
            $hash = $request->route('hash');
            if ($hash) {
                if ($bin->private_hash == $hash) {
                    if (!session()->has('private-' . $bin->getRouteKey()) ||
                        session()->get('private-' . $bin->getRouteKey()) !== $bin->private_hash
                    ) {
                        session(['private-' . $bin->getRouteKey() => $bin->private_hash]);
                    }

                    return true;
                }
            }
        }

        return false;
    }
}
