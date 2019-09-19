<?php

namespace Tnt\Helpers\Console\Media;

use dry\media\File;
use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Filesystem\Facade\Filesystem;

class SanityCheck extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('sanity-check')
            ->setDescription('Perform a sanity check');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeLine('Starting media sanity check');

        $errors = [0, 0, 0,];

        foreach (File::all() as $f)
        {
            $filename = 'media/'.$f->filename;

            if (!Filesystem::exists($filename)) {
                $errors[0]++;
                $output->writeLine('[File '.$f->id.'] File could not be found at '.$filename, OutputInterface::TYPE_ERROR);
                continue;
            }

            if (!Filesystem::isWriteable($filename)) {
                $errors[1]++;
                $output->writeLine('[File '.$f->id.'] File is not writable at '.$filename, OutputInterface::TYPE_ERROR);
                continue;
            }

            if ($f->mimetype !== Filesystem::mimetype($filename)) {
                $errors[2]++;
                $output->writeLine('[File '.$f->id.'] Incorrect mimetype ('.$f->mimetype.' !== '.Filesystem::mimetype($filename).')', OutputInterface::TYPE_ERROR);
            }
        }

        $success = (array_sum($errors) === 0);

        if (!$success) {
            $output->writeLine('Sanity check completed (FAIL)', OutputInterface::TYPE_ERROR);
            $output->writeLine('Not found: ' .$errors[0], OutputInterface::TYPE_ERROR);
            $output->writeLine('Not writeable: ' .$errors[1], OutputInterface::TYPE_ERROR);
            $output->writeLine('Incorrect mimetypes: ' .$errors[2], OutputInterface::TYPE_ERROR);
            return;
        }

        $output->writeLine('Sanity check completed (OK) ', OutputInterface::TYPE_INFO);
    }
}