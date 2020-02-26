<?php

namespace Aliqsyed\Scaffolder\Commands;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\Model\Model;
use Aliqsyed\Scaffolder\MissingTableException;

class CreateModel extends Scaffold
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolder:model {table} {--force} {--nosetters} {--nocasts} {--nostubs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create model for a database table';

    protected $tablename;

    /**
     * Execute the console command.
     *
     * @param \Aliqsyed\Scaffolder\Table
     *
     * @return Array
     */
    public function handle()
    {
        $this->tablename = $this->argument('table');
        $dir = app_path();

        try {
            $this->createModel($dir);
            $this->printFilesCreated();
        } catch (MissingTableException $e) {
            $this->error('There were no columns found for this table.');
            $this->error('Please make sure the table name matches the table name in the database');
        }
    }

    protected function createModel($dir)
    {
        $model = Model::create(
            $this->tablename,
            $this->option('nosetters'),
            $this->option('nocasts'),
            $this->option('nostubs')
        );

        $this->writeToFile(
            $dir,
            Table::modelName($this->tablename) . '.php',
            $model->getModel()
        );
    }
}
