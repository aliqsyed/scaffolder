<?php

namespace Aliqsyed\Scaffolder\Commands;

use Illuminate\Console\Command;
use Aliqsyed\Scaffolder\FileWriter;

abstract class Scaffold extends Command
{
    /**
     * FileWriter instance variable
     *
     * @var Aliqsyed\Scaffolder\FileWriter
     */
    protected $fw;

    /**
     * Create a new command instance.
     *
     * @var Aliqsyed\Scaffolder\FileWriter
     *
     * @return void
     */
    public function __construct(FileWriter $fw)
    {
        parent::__construct();
        $this->fw = $fw;
    }

    protected function confirmSave($dir, $filename)
    {
        return $this->option('force') ||
      (!$this->fw->fileExists($dir, $filename)) ||
      $this->confirm("$filename already exists in $dir. Do you want to overwrite it?");
    }

    protected function writeToFile($dir, $filename, $content)
    {
        if ($this->confirmSave($dir, $filename)) {
            $this->fw->writeToFile($dir, $filename, $content);
        }
    }

    protected function appendToFile($dir, $filename, $content)
    {
        $appended = $this->fw->appendToFile($dir, $filename, $content);

        if (!$appended) {
            $this->error('Couldn\'t append to ' . $dir . '/' . $filename);
        }
    }

    protected function printFilesCreated()
    {
        $this->info("\nThe following files were successfully created:\n");

        foreach ($this->fw->filesCreated() as $file) {
            $this->line("$file");
        }

        $this->line("\n");
    }

    protected function printFilesAppended()
    {
        $this->info("\nThe following files were successfully updated:\n");

        foreach ($this->fw->filesAppended() as $file) {
            $this->line("$file");
        }

        $this->line("\n");
    }
}
