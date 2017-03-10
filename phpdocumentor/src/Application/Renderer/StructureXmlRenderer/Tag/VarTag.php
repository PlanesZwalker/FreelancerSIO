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

namespace phpDocumentor\Application\Renderer\StructureXmlRenderer\Tag;

use phpDocumentor\Application\Renderer\StructureXmlRenderer\Tag\ParamTag;

/**
 * Behaviour that adds support for the @method tag
 */
class VarTag extends ParamTag
{
    protected $element_name = 'var';
}
