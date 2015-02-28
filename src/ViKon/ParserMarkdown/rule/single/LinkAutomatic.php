<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class LinkAutomatic
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\single
 */
class LinkAutomatic extends AbstractSingleRule {
    const NAME = 'link_automatic';

    /**
     * Create new Link rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 170, '<\\b(?:ftp|http|https)://(?:[\\da-z-]++\\.)+[a-z]{2,6}/?>', $set);
    }

    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/<(\\b(?:ftp|http|https):\\/\\/(?:[\\da-z-]++\\.)+[a-z]{2,6}\\/?)>/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('url', $matches[1]);
    }
}