<?php

namespace Tnt\Helpers\Console\Template;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class Template extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('template')
			->addSubCommand(new ClearCache())
			;
	}
}