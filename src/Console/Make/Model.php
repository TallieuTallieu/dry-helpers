<?php

namespace Tnt\Helpers\Console\Make;

use Oak\Console\Command\Argument;
use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Filesystem\Facade\Filesystem;

class Model extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('model')
			->setDescription('Generates a model class')
			->addArgument(Argument::create('name')->setDescription('The name of the model'));
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$className = ucwords(str_replace(' ', '', $input->getArgument('name')));
		$tableName = strtolower($className);
		$filename = 'app/'.$className.'.php';

		if (Filesystem::exists($filename)) {
			$output->writeLine('File '.$filename.' already exists', OutputInterface::TYPE_ERROR);
			return;
		}

		$source = "<?php

use \dry\orm\Model;

class ".$className." extends Model
{
	const TABLE = '".$tableName."';
}";

		Filesystem::put($filename, $source);

		$output->writeLine('Model '.$className.' created!', OutputInterface::TYPE_INFO);
	}
}