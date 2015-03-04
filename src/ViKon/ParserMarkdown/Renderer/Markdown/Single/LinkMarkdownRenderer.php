<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Single\LinkAtxRule;
use ViKon\ParserMarkdown\Rule\Single\LinkInlineRule;
use ViKon\ParserMarkdown\Rule\Single\LinkReferenceRule;
use ViKon\ParserMarkdown\Rule\Single\LinkSetextRule;

/**
 * Class LinkMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Single
 */
class LinkMarkdownRenderer extends AbstractMarkdownRuleRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(LinkInlineRule::NAME, [$this, 'renderLinkInline'], $this->skin);
        $renderer->registerTokenRenderer(LinkReferenceRule::NAME, [$this, 'renderLinkReference'], $this->skin);
    }

     /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderLinkInline(Token $token) {
        $label = $token->get('label', '');
        $url = $token->get('url', '');
        $title = $token->get('title', '');

        if (empty($title)) {
            return "[$label]($url)";
        }

        return "[$label]($url \"$title\")";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderLinkReference(Token $token) {
        return $token->get('match', '');
    }
}