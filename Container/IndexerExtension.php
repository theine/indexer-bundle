<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\IndexerComponent\Container;

use Phlexible\Container\ContainerBuilder;
use Phlexible\Container\Extension\Extension;
use Phlexible\Container\Loader\YamlFileLoader;
use Phlexible\IndexerComponent\Container\Compiler\AddIndexersPass;
use Phlexible\IndexerComponent\Container\Compiler\AddStoragesPass;

/**
 * Indexer extension
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class IndexerExtension extends Extension
{
    public function load(ContainerBuilder $container, array $configs)
    {
        $loader = new YamlFileLoader($container);
        $loader->load(__DIR__ . '/../_config/services.yml');

        //$configuration = $this->getConfiguration($container);
        //$config = $this->processConfiguration($configuration, $configs);

        $container->setParameters(
            array(
                'indexer.asset.script_path' => __DIR__ . '/../_scripts',
                'indexer.asset.css_path'    => __DIR__ . '/../_styles',
            )
        );

        $container->registerCompilerPass(new AddIndexersPass());
        $container->registerCompilerPass(new AddStoragesPass());
    }
}