<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\Parser\rule\AbstractSingleRule;

class Hr extends AbstractSingleRule
{
    const NAME = 'hr';

    /**
     * Create new Hr rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set)
    {
        parent::__construct(self::NAME, 10, '\n(?:[\*\_\-] *){3,}', $set);
    }
}