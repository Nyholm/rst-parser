<?php

declare(strict_types=1);

namespace Doctrine\RST\Nodes;

class AnchorNode extends Node
{
    /** @var string */
    protected $value;

    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
