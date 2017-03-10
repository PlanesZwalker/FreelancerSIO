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

namespace phpDocumentor\Application\Console\Command;

use League\Event\Emitter;
use League\Tactician\CommandBus;
use phpDocumentor\Application\Configuration\ConfigurationFactory;
use phpDocumentor\DomainModel\Parse;
use phpDocumentor\DomainModel\Dsn;
use phpDocumentor\DomainModel\Parser\Documentation;
use phpDocumentor\DomainModel\Parser\DocumentationRepository;
use phpDocumentor\Infrastructure\FileSystemFactory;
use phpDocumentor\Infrastructure\Parser\Documentation\Api\FlySystemDefinition;
use phpDocumentor\DomainModel\Parser\ApiFileParsed;
use phpDocumentor\DomainModel\Parser\ApiParsingStarted;
use phpDocumentor\DomainModel\ConfigureCache;
use phpDocumentor\DomainModel\MergeConfigurationWithCommandLineOptions;
use phpDocumentor\DomainModel\Render;
use phpDocumentor\DomainModel\Parser\Version\DefinitionRepository;
use phpDocumentor\DomainModel\Renderer\RenderActionCompleted;
use phpDocumentor\DomainModel\Renderer\RenderingFinished;
use phpDocumentor\DomainModel\Renderer\RenderingStarted;
use Stash\Driver\FileSystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Parse and transform the given directory (-d|-f) to the given location (-t).
 *
 * phpDocumentor creates documentation from PHP source files. The simplest way
 * to use it is:
 *
 *     $ phpdoc run -d <directory to parse> -t <output directory>
 *
 * This will parse every file ending with .php, .php3 and .phtml in <directory
 * to parse> and then output a HTML site containing easily readable documentation
 * in <output directory>.
 *
 * phpDocumentor will try to look for a phpdoc.dist.xml or phpdoc.xml file in your
 * current working directory and use that to override the default settings if
 * present. In the configuration file can you specify the same settings (and
 * more) as the command line provides.
 */
final class RunCommand extends Command
{
    /** @var CommandBus */
    private $commandBus;

    /** @var Emitter */
    private $emitter;

    /** @var DefinitionRepository */
    private $definitionRepository;

    /** @var DocumentationRepository */
    private $documentationRepository;

    /** @var ConfigurationFactory */
    private $configurationFactory;

    /** @var FileSystemFactory */
    private $fileSystemFactory;

    /**
     * Initializes the command with all necessary dependencies
     *
     * @param DefinitionRepository $definitionRepository
     * @param DocumentationRepository $documentationRepository
     * @param CommandBus $commandBus
     * @param Emitter $emitter
     * @param ConfigurationFactory $configurationFactory
     * @param FileSystemFactory $fileSystemFactory
     */
    public function __construct(
        DefinitionRepository $definitionRepository,
        DocumentationRepository $documentationRepository,
        CommandBus $commandBus,
        Emitter $emitter,
        ConfigurationFactory $configurationFactory,
        FileSystemFactory $fileSystemFactory
    ) {
        $this->commandBus                   = $commandBus;
        $this->emitter                      = $emitter;
        $this->definitionRepository         = $definitionRepository;
        $this->documentationRepository      = $documentationRepository;
        $this->configurationFactory         = $configurationFactory;
        $this->fileSystemFactory            = $fileSystemFactory;

        parent::__construct('project:run');
    }

    /**
     * Initializes this command and sets the name, description, options and
     * arguments.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setAliases(array('run'))
            ->setDescription(
                'Parses and transforms the given files to a specified location'
            )
            ->setHelp(
                <<<HELP
phpDocumentor creates documentation from PHP source files. The simplest way
to use it is:

    <info>$ phpdoc run -d [directory to parse] -t [output directory]</info>

This will parse every file ending with .php, .php3 and .phtml in <directory
to parse> and then output a HTML site containing easily readable documentation
in <output directory>.

phpDocumentor will try to look for a phpdoc.dist.xml or phpdoc.xml file in your
current working directory and use that to override the default settings if
present. In the configuration file can you specify the same settings (and
more) as the command line provides.

<comment>Other commands</comment>
In addition to this command phpDocumentor also supports additional commands:

<comment>Available commands:</comment>
<info>  help
  list
  parse
  run
  transform
<comment>project</comment>
  project:parse
  project:run
  project:transform
<comment>template</comment>
  template:generate
  template:list
  template:package</info>

You can get a more detailed listing of the commands using the <info>list</info>
command and get help by prepending the word <info>help</info> to the command
name.
HELP
            )
            ->addOption(
                'target',
                't',
                InputOption::VALUE_OPTIONAL,
                'Path where to store the generated output'
            )
            ->addOption(
                'cache-folder',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path where to store the cache files'
            )
            ->addOption(
                'filename',
                'f',
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'Comma-separated list of files to parse. The wildcards ? and * are supported'
            )
            ->addOption(
                'directory',
                'd',
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'Comma-separated list of directories to (recursively) parse'
            )
            ->addOption(
                'encoding',
                null,
                InputOption::VALUE_OPTIONAL,
                'encoding to be used to interpret source files with'
            )
            ->addOption(
                'extensions',
                'e',
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'Comma-separated list of extensions to parse, defaults to php, php3 and phtml'
            )
            ->addOption(
                'ignore',
                'i',
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'Comma-separated list of file(s) and directories (relative to the source-code directory) that will be '
                . 'ignored. Wildcards * and ? are supported'
            )
            ->addOption(
                'markers',
                'm',
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'Comma-separated list of markers/tags to filter'
            )
            ->addOption(
                'title',
                null,
                InputOption::VALUE_OPTIONAL,
                'Sets the title for this project; default is the phpDocumentor logo'
            )
            ->addOption(
                'force',
                null,
                InputOption::VALUE_NONE,
                'Forces a full build of the documentation, does not increment existing documentation'
            )
            ->addOption(
                'visibility',
                null,
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'Specifies the parse visibility that should be displayed in the documentation (comma separated e.g. '
                . '"public,protected")'
            )
            ->addOption(
                'defaultpackagename',
                null,
                InputOption::VALUE_OPTIONAL,
                'Name to use for the default package.'
            )
            ->addOption(
                'sourcecode',
                null,
                InputOption::VALUE_NONE,
                'Whether to include syntax highlighted source code'
            )
            ->addOption(
                'progressbar',
                'p',
                InputOption::VALUE_NONE,
                'Whether to show a progress bar; will automatically quiet logging to stdout'
            )
            ->addOption(
                'template',
                null,
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'Name of the template to use (optional)'
            )
            ->addOption(
                'parseprivate',
                null,
                InputOption::VALUE_NONE,
                'Whether to parse DocBlocks marked with @internal tag'
            )
            ->addArgument(
                'paths',
                InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
                'One or more files and folders to process',
                array()
            );

        parent::configure();
    }

    /**
     * Executes the business logic involved with this command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->outputHeader($output);
        $this->attachListeners($input, $output);

        $this->mergeArgumentsIntoConfiguration($input);
        $destination = $this->getDestination();

        $this->configureCache();
        $this->renderDocumentationTo($destination);

        $this->outputFooter($output, $destination);
    }

    /**
     * Connect a series of output messages to various events to display progress.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    private function attachListeners(InputInterface $input, OutputInterface $output)
    {
        $this->emitter->addListener(
            ApiParsingStarted::class,
            function (ApiParsingStarted $event) use ($output) {
                /** @var FlySystemDefinition $definition */
                $definition = $event->definition();
                $output->writeln(
                    sprintf('Parsing <info>%d</info> files', count($definition->getFiles()))
                );
            }
        );
        $this->emitter->addListener(
            ApiFileParsed::class,
            function (ApiFileParsed $event) use ($output) {
                $output->writeln(sprintf('  Parsed <info>%s</info>', (string)$event->filename()));
            }
        );
        $this->emitter->addListener(
            RenderingStarted::class,
            function (RenderingStarted $event) use ($output) {
                $output->writeln('Started rendering');
            }
        );
        $this->emitter->addListener(
            RenderingFinished::class,
            function (RenderingFinished $event) use ($output) {
                $output->writeln('Completed rendering');
            }
        );
        $this->emitter->addListener(
            RenderActionCompleted::class,
            function (RenderActionCompleted $event) use ($output) {
                $output->writeln(sprintf('  %s', (string)$event->action()));
            }
        );
    }

    /**
     * @return Dsn
     */
    private function getDestination()
    {
        $config = $this->configurationFactory->get();

        return $config['phpdocumentor']['paths']['output'];
    }

    /**
     * Returns the destination as a string and expands it to show the absolute path if the destination is on disk.
     *
     * Because the destination location is created during rendering we can only expand the path using realpath
     * because realpath will return false on a non-existent location.
     *
     * @param Dsn $destination
     *
     * @return string
     */
    private function getExpandedDestination($destination)
    {
        return $destination->getScheme() == 'file'
            ? realpath($destination->getPath())
            : $destination;
    }

    private function getTemplates()
    {
        $config = $this->configurationFactory->get();

        return $config['phpdocumentor']['templates'];
    }

    private function configureCache()
    {
        $config = $this->configurationFactory->get();

        $cacheLocation = $config['phpdocumentor']['paths']['cache'];
        $cacheEnabled = $config['phpdocumentor']['use-cache'];

        $this->commandBus->handle(new ConfigureCache($cacheLocation, $cacheEnabled));
    }

    /**
     * @param OutputInterface $output
     */
    protected function outputHeader(OutputInterface $output)
    {
        $output->writeln(
            sprintf(
                '<info>%s</info> version <comment>%s</comment>' . PHP_EOL,
                $this->getApplication()->getName(),
                $this->getApplication()->getVersion()
            )
        );
    }

    private function mergeArgumentsIntoConfiguration(InputInterface $input)
    {
        $this->commandBus->handle(
            new MergeConfigurationWithCommandLineOptions($input->getOptions(), $input->getArguments())
        );
    }

    private function renderDocumentationTo($destination)
    {
        $destinationFilesystem = $this->fileSystemFactory->create($destination);
        $templates = $this->getTemplates();

        foreach ($this->definitionRepository->fetchAll() as $definition) {
            // TODO: Does this mean that once cached it is never refreshed?
            if (!$this->documentationRepository->hasForVersionNumber($definition->getVersionNumber())) {
                $this->commandBus->handle(new Parse($definition));
            }

            $documentation = $this->documentationRepository->findByVersionNumber($definition->getVersionNumber());

            $this->commandBus->handle(new Render($documentation, $destinationFilesystem, $templates));
        }
    }

    private function outputFooter(OutputInterface $output, $destination)
    {
        $expandedDestination = $this->getExpandedDestination($destination);
        $output->writeln(sprintf(PHP_EOL . '<fg=black;bg=green>OK (%s)</>', $expandedDestination));
    }
}
