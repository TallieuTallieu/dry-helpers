<?php

namespace Tnt\Helpers\Console\Newsletter;

use dry\newsletter\Subscriber;
use Oak\Console\Command\Argument;
use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;

class Subscribe extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('subscribe')
			->setDescription('Creates a new newsletter subscriber')
			->addArgument(Argument::create('email')->setDescription('Email address for the subscriber'))
			;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$subscriber = new Subscriber();
		$subscriber->email = $input->getArgument('email');
		$subscriber->save();

		$output->writeLine('Subscriber successfully created');
	}
}