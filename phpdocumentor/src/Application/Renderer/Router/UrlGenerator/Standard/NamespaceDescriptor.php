<?php
/**
 * phpDocumentor
 *
 * PHP Version 5.4
 *
 * @copyright 2010-2014 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Application\Renderer\Router\UrlGenerator\Standard;

use phpDocumentor\Descriptor;
use phpDocumentor\DomainModel\Renderer\Router\UrlGenerator\UrlGeneratorInterface;

class NamespaceDescriptor implements UrlGeneratorInterface
{
    /**
     * Generates a URL from the given node or returns false if unable.
     *
     * @param string|Descriptor\NamespaceDescriptor $node
     *
     * @return string|false
     */
    public function __invoke($node)
    {
        $converter = new QualifiedNameToUrlConverter();

        return '/namespaces/' . $converter->fromNamespace($node->getFullyQualifiedStructuralElementName()) .'.html';
    }
}
