<?php

namespace Tnt\Helpers\Console\Template;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Filesystem\Facade\Filesystem;

class ClearCache extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('clear-cache')
            ->setDescription('Clear the template cache')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = Filesystem::files('cache/templates');

        foreach ($files as $file) {
            Filesystem::delete($file);
        }

        $output->writeLine('Template cache cleared', OutputInterface::TYPE_INFO);
    }
}