<?php

namespace Tnt\Helpers\Console\Media;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Filesystem\Facade\Filesystem;

class Clear extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('clear')
            ->setDescription('Clear generated media formats');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dirs = Filesystem::directories('media');

        foreach ($dirs as $dir) {
            $files  = Filesystem::files($dir);

            foreach ($files as $file) {
                Filesystem::delete($file);
            }
        }

        $output->writeLine('All generated media formats cleared!', OutputInterface::TYPE_INFO);
    }
}