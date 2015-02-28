<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class HeaderAtx
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\single
 */
class HeaderAtx extends AbstractSingleRule {
    const NAME = 'header_atx';

    /**
     * Create new Header ATX rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 60, '^[ \t]*#{1,6}[^\n]+(?=\n)', $set);
    }

    protected function handleSingleState($content, $position, TokenList $tokenList) {
        $content = trim($content);
        preg_match('/^#{1,6}/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('level', abs(strlen($matches[0])))
            ->set('content', trim($content, "# \t"));

        return true;
    }
}