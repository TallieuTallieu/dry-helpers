<?php

namespace Tnt\Helpers\Console\Heml;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class Heml extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('heml')
            ->addSubCommand(Install::class)
            ;
    }
}