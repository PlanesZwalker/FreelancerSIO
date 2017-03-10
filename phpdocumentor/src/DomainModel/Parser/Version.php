<?php
/**
 * phpDocumentor
 *
 * PHP Version 5.5
 *
 * @copyright 2010-2015 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\DomainModel\Parser;

use phpDocumentor\DomainModel\Parser\Version\Number;

/**
 * Version Entity
 */
final class Version
{
    /**
     * number of this version.
     *
     * @var Number
     */
    private $versionNumber;

    /**
     * Initializes the object.
     *
     * @param Number $versionNumber
     */
    public function __construct(Number $versionNumber)
    {
        $this->versionNumber = $versionNumber;
    }

    /**
     * Return number of this version.
     *
     * @return Number
     */
    public function getVersionNumber()
    {
        return $this->versionNumber;
    }
}
