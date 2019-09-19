<?php

namespace Tnt\Helpers\Console\Newsletter;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class Newsletter extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('newsletter')
            ->addSubCommand(Subscribe::class)
            ->addSubCommand(Status::class)
        ;
    }
}