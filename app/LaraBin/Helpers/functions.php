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

function markdown() {
    return new \App\LaraBin\Services\Markdown\LaraBinParse();
}

function binVisibility() {
    return [
        0 => 'Private',
        1 => 'Public',
        2 => 'Unlisted'
    ];
}

function settings($key = null)
{
    $settings = app('App\LaraBin\Helpers\Settings');
    return $key ? $settings->get($key) : $settings;
}