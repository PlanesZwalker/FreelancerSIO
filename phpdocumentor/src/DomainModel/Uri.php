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

namespace phpDocumentor\DomainModel;

/**
 * Value object for uri.
 * Uri can be either local or remote.
 */
final class Uri
{
    /**
     * Uri path.
     *
     * @var string
     */
    private $uri;

    /**
     * Initializes the Uri.
     *
     * @param string $uri
     */
    public function __construct($uri)
    {
        $this->validateString($uri);

        $uri = $this->addFileSchemeWhenSchemeIsAbsent($uri);

        $this->validateUri($uri);

        $this->uri = $uri;
    }

    /**
     * Returns a string representation of the uri.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->uri;
    }

    /**
     * Checks if the provided uri is equal to the current uri.
     *
     * @param Uri $other
     *
     * @return bool
     */
    public function equals($other)
    {
        return $other == $this;
    }

    /**
     * Checks if $uri is of type string.
     *
     * @param string $uri
     *
     * @throws \InvalidArgumentException if $uri is not a string.
     * @return void
     */
    private function validateString($uri)
    {
        if (!is_string($uri)) {
            throw new \InvalidArgumentException(sprintf('String required, %s given', gettype($uri)));
        }
    }

    /**
     * Checks if $uri is valid.
     *
     * @param string $uri
     *
     * @throws \InvalidArgumentException if $uri is not a valid uri.
     * @return void
     */
    private function validateUri($uri)
    {
        if (filter_var($uri, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid uri', $uri));
        }
    }

    /**
     * Checks if a scheme is present.
     * If no scheme is found, it is assumed that a local path is used, and file:// is prepended.
     *
     * @param string $uri
     *
     * @return string
     */
    private function addFileSchemeWhenSchemeIsAbsent($uri)
    {
        if (!parse_url($uri, PHP_URL_SCHEME)) {
            $uri = 'file://' . $uri;
        }

        return $uri;
    }
}
