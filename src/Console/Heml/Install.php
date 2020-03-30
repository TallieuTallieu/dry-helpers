<?php

namespace Tnt\Helpers\Console\Heml;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Filesystem\Facade\Filesystem;

class Install extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('install')
            ->setDescription('Install Heml dependencies')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo `npm install --save gulp-heml gulp-ext-replace gulp-file-include gulp-replace`;

        self::append('gulpfile.js', "require('./gulp/heml.js');", $output);
        self::append('.gitignore', "app/templates/heml/", $output);

        self::copyFiles(__DIR__.'/Resources/gulp', 'gulp', $output);

        self::copyFiles(__DIR__.'/Resources/assets/heml', 'assets/heml', $output);
        self::copyFiles(__DIR__.'/Resources/assets/heml/styles', 'assets/heml/styles', $output);
        self::copyFiles(__DIR__.'/Resources/assets/heml/partials', 'assets/heml/partials', $output);
        self::copyFiles(__DIR__.'/Resources/assets/heml/page-blocks', 'assets/heml/page-blocks', $output);
        self::copyFiles(__DIR__.'/Resources/assets/img', 'assets/heml/img', $output);
    }

    private static function copyFiles(string $filesPath, string $outputPath, OutputInterface $output)
    {
        $files = Filesystem::files($filesPath);

        foreach ($files as $file) {
            $basename = basename($file);
            $output->writeLine('Copying '.$basename.' to '.$outputPath);
            Filesystem::copy($file, $outputPath.'/'.$basename);
        }
    }

    private static function append(string $fileName, string $contents, OutputInterface $output)
    {
        if (Filesystem::exists($fileName)) {
            Filesystem::append($fileName, PHP_EOL . $contents);
            $output->writeLine('Appended '.$contents.' to '.$fileName);
        }
    }
}