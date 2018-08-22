<?php

declare(strict_types=1);

namespace Doctrine\RST\LaTeX\Directives;

use Doctrine\RST\Directive;
use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Nodes\RawNode;
use Doctrine\RST\Parser;

/**
 * Add a meta title to the document
 *
 * .. title:: Page title
 */
class Title extends Directive
{
    public function getName() : string
    {
        return 'title';
    }

    /**
     * @param string[] $options
     */
    public function process(
        Parser $parser,
        ?Node $node,
        string $variable,
        string $data,
        array $options
    ) : void {
        $document = $parser->getDocument();

        $document->addHeaderNode(new RawNode('\title{' . $data . '}'));

        if ($node === null) {
            return;
        }

        $document->addNode($node);
    }
}
