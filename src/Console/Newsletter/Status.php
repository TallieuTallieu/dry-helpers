<?php

namespace Tnt\Helpers\Console\Newsletter;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;

class Status extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('status')
			->setDescription('Show the status of the newsletter system')
			;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeLine('TODO');
	}
}