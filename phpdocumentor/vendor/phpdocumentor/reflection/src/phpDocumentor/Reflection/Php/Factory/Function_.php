<?php
/**
     * This file is part of phpDocumentor.
     *
     * For the full copyright and license information, please view the LICENSE
     * file that was distributed with this source code.
     *
     * @copyright 2010-2015 Mike van Riel<mike@phpdoc.org>
     * @license   http://www.opensource.org/licenses/mit-license.php MIT
     * @link      http://phpdoc.org
     */

namespace phpDocumentor\Reflection\Php\Factory;

use InvalidArgumentException;
use phpDocumentor\Reflection\Fqsen;
use phpDocumentor\Reflection\Php\Factory;
use phpDocumentor\Reflection\Php\Function_ as FunctionDescriptor;
use phpDocumentor\Reflection\Php\ProjectFactoryStrategy;
use phpDocumentor\Reflection\Php\StrategyContainer;
use phpDocumentor\Reflection\Types\Context;
use PhpParser\Comment\Doc;
use PhpParser\Node\Stmt\Function_ as FunctionNode;

/**
 * Strategy to convert Function_ to FunctionDescriptor
 *
 * @see FunctionDescriptor
 * @see \PhpParser\Node\
 */
// @codingStandardsIgnoreStart
final class Function_ extends AbstractFactory implements ProjectFactoryStrategy
// @codingStandardsIgnoreEnd
{

    /**
     * Returns true when the strategy is able to handle the object.
     *
     * @param FunctionNode $object object to check.
     * @return boolean
     */
    public function matches($object)
    {
        return $object instanceof FunctionNode;
    }

    /**
     * Creates an FunctionDescriptor out of the given object including its child elements.
     *
     * @param \PhpParser\Node\Stmt\Function_ $object object to convert to an Element
     * @param StrategyContainer $strategies used to convert nested objects.
     * @param Context $context of the created object
     * @return FunctionDescriptor
     */
    protected function doCreate($object, StrategyContainer $strategies, Context $context = null)
    {
        $docBlock = $this->createDocBlock($strategies, $object->getDocComment(), $context);

        $function = new FunctionDescriptor($object->fqsen, $docBlock);

        foreach ($object->params as $param) {
            $strategy = $strategies->findMatching($param);
            $function->addArgument($strategy->create($param, $strategies, $context));
        }

        return $function;
    }
}
