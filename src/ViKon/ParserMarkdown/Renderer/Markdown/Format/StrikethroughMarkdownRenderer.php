<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\StrikethroughRule;

/**
 * Class StrikethroughMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Format
 */
class StrikethroughMarkdownRenderer extends AbstractMarkdownRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(StrikethroughRule::NAME . '_open', [$this, 'renderStrikethroughOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrikethroughRule::NAME, [$this, 'renderStrikethrough'], $this->skin);
        $renderer->registerTokenRenderer(StrikethroughRule::NAME . '_close', [$this, 'renderStrikethroughClose'], $this->skin);

    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrikethroughOpen(Token $token) {
        return '~~';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderStrikethrough(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrikethroughClose(Token $token) {
        return '~~';
    }
}