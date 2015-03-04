<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;

/**
 * Class StrongMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Format
 */
class StrongMarkdownRenderer extends AbstractMarkdownRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(StrongRule::NAME . '_open', [$this, 'renderStrongOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongRule::NAME, [$this, 'renderStrong'], $this->skin);
        $renderer->registerTokenRenderer(StrongRule::NAME . '_close', [$this, 'renderStrongClose'], $this->skin);

        $renderer->registerTokenRenderer(StrongAltRule::NAME . '_open', [$this, 'renderStrongAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongAltRule::NAME, [$this, 'renderStrongAlt'], $this->skin);
        $renderer->registerTokenRenderer(StrongAltRule::NAME . '_close', [$this, 'renderStrongAltClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongOpen(Token $token) {
        return '**';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderStrong(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongClose(Token $token) {
        return '**';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongAltOpen(Token $token) {
        return '__';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderStrongAlt(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongAltClose(Token $token) {
        return '__';
    }
}