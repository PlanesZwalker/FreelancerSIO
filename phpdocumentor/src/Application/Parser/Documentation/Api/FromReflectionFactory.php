<?php
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2016 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Application\Parser\Documentation\Api;

use InvalidArgumentException;
use League\Event\Emitter;
use phpDocumentor\DomainModel\Parser\ApiParsingCompleted;
use phpDocumentor\DomainModel\Parser\ApiParsingStarted;
use phpDocumentor\DomainModel\Parser\Documentation\Api\Api;
use phpDocumentor\DomainModel\Parser\Documentation\Api\Definition;
use phpDocumentor\DomainModel\Parser\Documentation\DocumentGroup;
use phpDocumentor\DomainModel\Parser\Documentation\DocumentGroup\Definition as DocumentGroupDefinitionInterface;
use phpDocumentor\DomainModel\Parser\Documentation\DocumentGroupFactory;
use phpDocumentor\Reflection\ProjectFactory;
use phpDocumentor\Reflection\Php\Factory\File;

final class FromReflectionFactory implements DocumentGroupFactory
{
    /** @var Emitter */
    private $emitter;

    /**
     * @var ProjectFactory
     */
    private $projectFactory;

    /**
     * @param Emitter $emitter
     * @param ProjectFactory $projectFactory
     */
    public function __construct(Emitter $emitter, ProjectFactory $projectFactory)
    {
        $this->emitter = $emitter;
        $this->projectFactory = $projectFactory;
    }

    /**
     * Creates Document group using the provided definition.
     *
     * @param DocumentGroupDefinitionInterface $definition
     * @return DocumentGroup
     */
    public function create(DocumentGroupDefinitionInterface $definition)
    {
        /** @var Definition $definition */
        if (!$this->matches($definition)) {
            throw new InvalidArgumentException('Definition must be an instance of ' . Definition::class);
        }

        // TODO: Read title (My Project) from configuration
        $this->emitter->emit(new ApiParsingStarted($definition));
        $project = $this->projectFactory->create('My Project', $definition->getFiles());
        $this->emitter->emit(new ApiParsingCompleted($definition));

        return new Api($definition->getFormat(), $project);
    }

    /**
     * Will return true when this factory can handle the provided definition.
     *
     * @param DocumentGroupDefinitionInterface $definition
     * @return boolean
     */
    public function matches(DocumentGroupDefinitionInterface $definition)
    {
        if ($definition instanceof Definition) {
            return true;
        }

        return false;
    }
}
