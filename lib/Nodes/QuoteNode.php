<?php

declare(strict_types=1);

namespace Doctrine\RST\Nodes;

/**
 * Represents a "Block Quote"
 *
 * https://docutils.sourceforge.io/docs/ref/rst/restructuredtext.html#block-quotes
 */
class QuoteNode extends Node
{
    /** @var DocumentNode */
    protected $value;

    public function __construct(DocumentNode $documentNode)
    {
        parent::__construct($documentNode);
    }

    public function getValue(): DocumentNode
    {
        return $this->value;
    }
}
