<?php

if (!function_exists('hashid')) {
    /**
     * Return Hashid instance
     *
     * @return \Hashids\Hashids
     */
    function hashid()
    {
        if (!env('HASHID_SALT')) {
            abort(403, 'HASHID env variable not set!');
        }

        return new Hashids\Hashids(env('HASHID_SALT'));
    }
}

use League\CommonMark\CommonMarkConverter;

function commonmark() {
    return new CommonMarkConverter();
}

function binVisibility() {
    return [
        0 => 'Private',
        1 => 'Public',
        2 => 'Unlisted'
    ];
}