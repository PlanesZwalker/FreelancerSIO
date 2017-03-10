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

namespace phpDocumentor\Application\Renderer\StructureXmlRenderer;

use phpDocumentor\Descriptor\ArgumentDescriptor;
use phpDocumentor\Descriptor\DescriptorAbstract;
use PhpParser\Node;
use PhpParser\PrettyPrinter\Standard;
use PhpParser\PrettyPrinterTest;

/**
 * Converter used to create an XML Element representing a method or function argument.
 */
class ArgumentConverter
{
    /**
     * Exports the given reflection object to the parent XML element.
     *
     * This method creates a new child element on the given parent XML element
     * and takes the properties of the Reflection argument and sets the
     * elements and attributes on the child.
     *
     * @param \DOMElement        $parent   The parent element to augment.
     * @param ArgumentDescriptor $argument The data source.
     *
     * @return \DOMElement
     */
    public function convert(\DOMElement $parent, ArgumentDescriptor $argument)
    {
        $child = new \DOMElement('argument');
        $parent->appendChild($child);

        $child->setAttribute('line', $argument->getLine());
        $child->setAttribute('by_reference', var_export($argument->isByReference(), true));
        $child->appendChild(new \DOMElement('name', $argument->getName()));

        $printer = new Standard();
        $default = $argument->getDefault();
        if ($default instanceof Node) {
            $default = substr($printer->prettyPrint([$default]), 0, -1);
        }
        $child->appendChild(new \DOMElement('default'))
              ->appendChild(new \DOMText($default));

        $types = $argument->getTypes();

        $typeStrings = array();
        foreach ($types as $type) {
            $typeStrings[] = $type instanceof DescriptorAbstract
                ? $type->getFullyQualifiedStructuralElementName()
                : $type;
        }
        $child->appendChild(new \DOMElement('type', implode('|', $typeStrings)));

        return $child;
    }
}
