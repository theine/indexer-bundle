<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\IndexerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\Console\Input\InputOption;

/**
 * Index command
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class IndexCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('indexer:index')
            ->setDescription('Run maintenance on index.')
            ->addOption('commit', null, InputOption::VALUE_NONE, 'Commit index')
            ->addOption('flush', null, InputOption::VALUE_NONE, 'Flush index')
            ->addOption('optimize', null, InputOption::VALUE_NONE, 'Optimize index')
            ->addOption('rollback', null, InputOption::VALUE_NONE, 'Rollback index')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        ini_set('memory_limit', -1);

        $storage = $this->getContainer()->get('phlexible_indexer.storage.default');

        $output->writeln('Committing storage ' . $storage->getConnectionString());

        $update = $storage->createUpdate();

        if ($input->getOption('commit')) {
            $update->commit();
        }
        if ($input->getOption('flush')) {
            $update->flush();
        }
        if ($input->getOption('optimize')) {
            $update->optimize();
        }
        if ($input->getOption('rollback')) {
            $update->rollback();
        }

        if ($storage->execute($update)) {
            $output->writeln('<info>Maintenance done.</info>');
        } else {
            $output->writeln('<erro>Maintenance failed.</erro>');
        }

        return 0;
    }

}