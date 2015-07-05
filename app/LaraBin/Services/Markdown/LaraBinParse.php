<?php

namespace App\LaraBin\Services\Markdown;

use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Yangqi\Htmldom\Htmldom;

class LaraBinParse
{
    /** @var Parser */
    private $service;

    public function renderComment($string)
    {
        $processed = $this->processCommentOutput($string);

        return $processed;
    }

    public function renderCode($string)
    {
        $processed = $this->processCodeOutput($string);

        return $processed;
    }

    // Private Methods

    private function processCommentOutput($string)
    {
        $rendered = $this->parseComment($string);

        $clean = $this->removeScriptTag($rendered);

        return $clean;
    }

    private function processCodeOutput($string)
    {
        $rendered = $this->parseCode($string);

        $clean = $this->removeScriptTag($rendered);

        return $clean;
    }

    private function parseComment($string)
    {
        $environment   = Environment::createCommonMarkEnvironment();
        $environment->addInlineParser(new MentionParser());
        $parser        = new DocParser($environment);
        $renderer      = new HtmlRenderer($environment);
        $this->service = new CommonMarkParser($environment, $parser, $renderer);

        return $this->service->render($string);
    }

    private function parseCode($string)
    {
        $environment   = Environment::createCommonMarkEnvironment();
        $environment->addInlineParser(new MentionParser());
        $parser        = new DocParser($environment);
        $renderer      = new HtmlRenderer($environment);
        $this->service = new CommonMarkParser($environment, $parser, $renderer);

        return $this->service->render($string);
    }

    private function removeScriptTag($string)
    {
        $dom = new \DOMDocument();

        $dom->loadHTML($string);

        $script = $dom->getElementsByTagName('script');

        $remove = [];
        foreach($script as $item)
        {
            $remove[] = $item;
        }

        foreach ($remove as $item)
        {
            $item->parentNode->removeChild($item);
        }

        $html = $dom->saveHTML();

        return $html;
    }
}