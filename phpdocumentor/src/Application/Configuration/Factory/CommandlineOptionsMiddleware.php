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

namespace phpDocumentor\Application\Configuration\Factory;

use phpDocumentor\DomainModel\Dsn;
use phpDocumentor\DomainModel\Path;

final class CommandlineOptionsMiddleware
{
    /** @var string[] */
    private $options = [];

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function provideOptions(array $options)
    {
        $this->options = $options;
    }

    public function __invoke(array $configuration)
    {
        $configuration = $this->overwriteDestinationFolder($configuration);
        $configuration = $this->disableCache($configuration);
        $configuration = $this->overwriteCacheFolder($configuration);
        $configuration = $this->overwriteTitle($configuration);
        $configuration = $this->overwriteTemplates($configuration);

        if (!isset($configuration['phpdocumentor']['versions'])) {
            return $configuration;
        }

        foreach ($configuration['phpdocumentor']['versions'] as &$version) {
            $version = $this->setFilesInPath($version);
            $version = $this->setDirectoriesInPath($version);
            $version = $this->registerExtensions($version);
            $version = $this->overwriteIgnoredPaths($version);
            $version = $this->overwriteMarkers($version);
            $version = $this->overwriteVisibility($version);
            $version = $this->overwriteDefaultPackageName($version);
        }

        return $configuration;
    }

    /**
     * @return array
     */
    public function createDefaultApiSettings()
    {
        return [
            'format'               => 'php',
            'source'               => [
                'dsn'   => 'file://.',
                'paths' => [new Path('.')]
            ],
            'ignore'               => [
                'hidden'   => true,
                'symlinks' => true,
                'paths'    => [],
            ],
            'extensions'           => ['php', 'php3', 'phtml'],
            'visibility'           => 'public',
            'default-package-name' => 'phpDocumentor',
            'markers'              => ['TODO', 'FIXME']
        ];
    }

    /**
     * @param $version
     *
     * @return mixed
     */
    private function setFilesInPath($version)
    {
        if (! isset($this->options['filename']) || ! $this->options['filename']) {
            return $version;
        }

        if (! isset($version['api'])) {
            $version['api'] = $this->createDefaultApiSettings();
        }

        $version['api']['source']['paths'] = array_map(
            function ($path) {
                return new Path($path);
            },
            $this->options['filename']
        );

        return $version;
    }

    /**
     * @param $version
     *
     * @return mixed
     */
    private function setDirectoriesInPath($version)
    {
        if (! isset($this->options['directory']) || ! $this->options['directory']) {
            return $version;
        }

        if (! isset($version['api'])) {
            $version['api'] = $this->createDefaultApiSettings();
        }

        $version['api']['source']['paths'] = array_map(
            function ($path) {
                return new Path($path);
            },
            $this->options['directory']
        );

        return $version;
    }

    /**
     * @param $version
     *
     * @return mixed
     */
    private function overwriteIgnoredPaths($version)
    {
        if (! isset($this->options['ignore']) || ! $this->options['ignore']) {
            return $version;
        }

        if (! isset($version['api'])) {
            $version['api'] = $this->createDefaultApiSettings();
        }

        $version['api']['ignore']['paths'] = array_map(
            function ($path) {
                return new Path($path);
            },
            $this->options['ignore']
        );

        return $version;
    }

    /**
     * @param $version
     *
     * @return mixed
     */
    private function registerExtensions($version)
    {
        if (!isset($this->options['extensions']) || ! $this->options['extensions']) {
            return $version;
        }

        if (! isset($version['api'])) {
            $version['api'] = $this->createDefaultApiSettings();
        }

        $version['api']['extensions'] = $this->options['extensions'];

        return $version;
    }

    /**
     * @param array $configuration
     *
     * @return array
     */
    private function overwriteDestinationFolder(array $configuration)
    {
        if (isset($this->options['target']) && $this->options['target']) {
            $configuration['phpdocumentor']['paths']['output'] = new Dsn($this->options['target']);
        }

        return $configuration;
    }

    /**
     * @param array $configuration
     *
     * @return array
     */
    private function overwriteCacheFolder(array $configuration)
    {
        if (isset($this->options['cache-folder']) && $this->options['cache-folder']) {
            $configuration['phpdocumentor']['paths']['cache'] = new Path($this->options['cache-folder']);
        }

        return $configuration;
    }

    /**
     * @param $version
     *
     * @return mixed
     */
    private function overwriteMarkers($version)
    {
        if (! isset($this->options['markers']) || ! $this->options['markers']) {
            return $version;
        }

        if (! isset($version['api'])) {
            $version['api'] = $this->createDefaultApiSettings();
        }

        $version['api']['markers'] = $this->options['markers'];

        return $version;
    }

    /**
     * @param $version
     *
     * @return mixed
     */
    private function overwriteVisibility($version)
    {
        if (! isset($this->options['visibility']) || ! $this->options['visibility']) {
            return $version;
        }

        if (! isset($version['api'])) {
            $version['api'] = $this->createDefaultApiSettings();
        }

        $version['api']['visibility'] = $this->options['visibility'];

        return $version;
    }

    /**
     * @param $version
     *
     * @return mixed
     */
    private function overwriteDefaultPackageName($version)
    {
        if (! isset($this->options['defaultpackagename']) || ! $this->options['defaultpackagename']) {
            return $version;
        }

        if (! isset($version['api'])) {
            $version['api'] = $this->createDefaultApiSettings();
        }

        $version['api']['default-package-name'] = $this->options['defaultpackagename'];

        return $version;
    }

    /**
     * @param array $configuration
     *
     * @return array
     */
    private function overwriteTitle(array $configuration)
    {
        if (isset($this->options['title']) && $this->options['title']) {
            $configuration['phpdocumentor']['title'] = $this->options['title'];
        }

        return $configuration;
    }

    /**
     * Changes the given configuration array to feature the templates from the options.
     *
     * @param string[] $configuration
     *
     * @return string[]
     */
    private function overwriteTemplates(array $configuration)
    {
        if (isset($this->options['template']) && $this->options['template']) {
            $configuration['phpdocumentor']['templates'] = (array)$this->options['template'];
        }

        return $configuration;
    }

    /**
     * Changes the given configuration array so that the cache handling is disabled.
     *
     * @param string[] $configuration
     *
     * @return string[]
     */
    private function disableCache($configuration)
    {
        if (isset($this->options['force']) && $this->options['force']) {
            $configuration['phpdocumentor']['use-cache'] = false;
        }

        return $configuration;
    }
}
