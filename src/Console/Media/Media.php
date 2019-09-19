<?php

namespace Tnt\Helpers\Console\Media;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class Media extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('media')
            ->addSubCommand(SanityCheck::class)
            ->addSubCommand(Clear::class)
            ;
    }
}