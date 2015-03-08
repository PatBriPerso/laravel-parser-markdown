<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Single\LinkAutoRule;
use ViKon\ParserMarkdown\Rule\Single\LinkInlineRule;
use ViKon\ParserMarkdown\Rule\Single\LinkReferenceRule;
use ViKon\ParserMarkdown\Rule\Single\ReferenceRule;

/**
 * Class LinkBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Single
 */
class LinkBootstrapRenderer extends AbstractBootstrapRuleRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(LinkInlineRule::NAME, [$this, 'renderInline'], $this->skin);
        $renderer->registerTokenRenderer(LinkReferenceRule::NAME, [$this, 'renderReference'], $this->skin);
        $renderer->registerTokenRenderer(LinkAutoRule::NAME, [$this, 'renderAuto'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderAuto(Token $token) {
        $url = $token->get('url', '');

        return "<a href=\"$url\">$url</a>";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderInline(Token $token) {
        $label = $token->get('label', '');
        $url = $token->get('url', '');
        $title = $token->get('title', '');

        if (empty($title)) {
            return "<a href=\"$url\">$label</a>";
        }

        return "<a href=\"$url\" title=\"$title\">$label</a>";
    }

    /**
     * @param \ViKon\Parser\Token     $token
     * @param \ViKon\Parser\TokenList $tokenList
     *
     * @return string
     * @throws \ViKon\Parser\LexerException
     */
    public function renderReference(Token $token, TokenList $tokenList) {
        $reference = $token->get('reference');
        $label = $token->get('label');

        if ($reference instanceof Token) {
            $referenceToken = $reference;
        } else {
            if (empty($reference) === '') {
                $reference = strtolower($token->get('label'));
            }

            $tokens = $tokenList->getTokensByCallback(function (Token $token) use ($reference) {
                return $token->getName() === ReferenceRule::NAME && $token->get('reference', null) === $reference;
            });
            // Get first token (if not found return full match)
            if (($referenceToken = reset($tokens)) === false) {
                return $token->get('match', '');
            }
            $referenceToken->set('used', true);
        }
        $url = $referenceToken->get('url');
        $title = $referenceToken->get('title', '');

        if (empty($title)) {
            return "<a href=\"$url\">$label</a>";
        }

        return "<a href=\"$url\" title=\"$title\">$label</a>";
    }
}