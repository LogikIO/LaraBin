<?php

namespace App\LaraBin\Services\Markdown;

use App\LaraBin\Models\User;
use League\CommonMark\ContextInterface;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\InlineParserContext;

class MentionParser extends AbstractInlineParser
{
    /**
     * @return array
     */
    public function getCharacters()
    {
        return ['@'];
    }

    /**
     * Parse @mentions from a string of text
     * https://github.com/thephpleague/commonmark/blob/gh-pages/customization/inline-parsing.md#example
     *
     * @param ContextInterface $context
     * @param InlineParserContext $inlineContext
     * @return bool
     */
    public function parse(ContextInterface $context, InlineParserContext $inlineContext)
    {
        $cursor = $inlineContext->getCursor();

        $previousChar = $cursor->peek(-1);

        if ($previousChar !== null && $previousChar !== ' ') {
            return false;
        }

        $previousState = $cursor->saveState();

        $cursor->advance();

        $handle = $cursor->match('/^\w+/');

        if (empty($handle)) {
            $cursor->restoreState($previousState);

            return false;
        }

        $user = User::where('username', $handle)->count();
        if (!$user) {
            $cursor->restoreState($previousState);

            return false;
        }

        $inlineContext->getInlines()->add(new Link(route('user', $handle), '@' . $handle));

        return true;
    }
}