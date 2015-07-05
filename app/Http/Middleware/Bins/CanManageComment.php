<?php

namespace App\Http\Middleware\Bins;

use App\LaraBin\Models\Bins\Comments\Comment;
use Closure;

class CanManageComment
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
        $comment = $request->route('comment');

        if (!static::canManageComment($comment)) {
            session()->flash('error', 'You do not have permission to manage this comment!');

            return redirect()->route('bin.code', $comment->bin->getRouteKey());
        }

        return $next($request);
    }

    private static function canManageComment(Comment $comment)
    {
        // Check if user is admin
        if (auth()->user()->admin()) {
            return true;
        }

        // Check if user is bin owner
        if (auth()->user()->getAuthIdentifier() == $comment->user_id) {
            return true;
        }

        return false;
    }
}
