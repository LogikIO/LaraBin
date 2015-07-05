<?php

namespace App\LaraBin\Services\Markdown;

interface Parser
{
    /**
     * Render a string of text
     *
     * @param string $text
     * @return string
     */
    public function render($string);

    /**
     * Extract the users from the text
     *
     * @param string $text
     * @return array
     */
    public function users($string);
}