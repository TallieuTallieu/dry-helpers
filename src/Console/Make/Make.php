<?php

namespace Tnt\Helpers\Console\Make;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class Make extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('make')
            ->addSubCommand(Model::class)
        ;
    }
}