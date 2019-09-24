<?php

namespace Tnt\Helpers\Console;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;

class Cli extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('cli')
            ->setDescription('Opens an interactive php shell');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        while( TRUE ) {
            echo '> ';
            $input = \readline();
            eval( $input );
            $output->newline();
        }
    }
}