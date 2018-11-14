<?php

declare(strict_types=1);

namespace Doctrine\RST;

use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Renderers\NodeRendererFactory;
use InvalidArgumentException;
use function in_array;
use function is_subclass_of;
use function sprintf;

class NodeInstantiator
{
    /** @var string */
    private $type;

    /** @var string */
    private $className;

    /** @var NodeRendererFactory|null */
    private $nodeRendererFactory;

    public function __construct(
        string $type,
        string $className,
        ?NodeRendererFactory $nodeRendererFactory = null
    ) {
        if (! in_array($type, NodeTypes::NODES, true)) {
            throw new InvalidArgumentException(
                sprintf('Node type %s is not a valid node type.', $type)
            );
        }

        if (! is_subclass_of($className, Node::class)) {
            throw new InvalidArgumentException(
                sprintf('%s class is not a subclass of %s', $className, Node::class)
            );
        }

        $this->type                = $type;
        $this->className           = $className;
        $this->nodeRendererFactory = $nodeRendererFactory;
    }

    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param mixed[] $arguments
     */
    public function create(array $arguments) : Node
    {
        /** @var Node $node */
        $node = new $this->className(... $arguments);

        if ($this->nodeRendererFactory !== null) {
            $node->setNodeRendererFactory($this->nodeRendererFactory);
        }

        return $node;
    }
}
