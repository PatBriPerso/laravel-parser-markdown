<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class EolRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class EolRule extends AbstractSingleRule {
    const NAME = 'EOL';
    const ORDER = 220;

    /**
     * Match
     *
     * new line feed (\n)
     *
     * match all empty characters
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '\n(?:[ \t]*(?=\n))?', $set);
    }
}