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

namespace phpDocumentor\Reflection\Php;

use \Mockery as m;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\Fqsen;

/**
 * Tests the functionality for the Function_ class.
 * @coversDefaultClass phpDocumentor\Reflection\Php\Function_
 */
// @codingStandardsIgnoreStart
class Function_Test extends \PHPUnit_Framework_TestCase
// @codingStandardsIgnoreEnd
{
    /** @var Function_ $fixture */
    protected $fixture;

    /** @var Fqsen */
    protected $fqsen;

    /** @var  DocBlock */
    protected $docBlock;

    /**
     * Creates a new (emoty) fixture object.
     */
    protected function setUp()
    {
        $this->fqsen = new Fqsen('\space\MyFunction()');
        $this->docBlock = new DocBlock('aa');
        $this->fixture = new Function_($this->fqsen, $this->docBlock);
    }

    /**
     * @covers ::__construct
     * @covers ::getName
     */
    public function testGetName()
    {
        $this->assertEquals('MyFunction', $this->fixture->getName());
    }

    /**
     * @covers ::addArgument
     * @covers ::getArguments
     */
    public function testAddAndGetArguments()
    {
        $argument = new Argument('firstArgument');
        $this->fixture->addArgument($argument);

        $this->assertEquals(array($argument), $this->fixture->getArguments());
    }

    /**
     * @covers ::__construct
     * @covers ::getFqsen
     */
    public function testGetFqsen()
    {
        $this->assertSame($this->fqsen, $this->fixture->getFqsen());
    }

    /**
     * @covers ::__construct
     * @covers ::getDocBlock
     */
    public function testGetDocblock()
    {
        $this->assertSame($this->docBlock, $this->fixture->getDocBlock());
    }
}
