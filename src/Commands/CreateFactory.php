<?php

namespace Aliqsyed\Scaffolder\Commands;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\Factory\Factory;
use Aliqsyed\Scaffolder\MissingTableException;

class CreateFactory extends Scaffold
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolder:factory {table} {--force} {--nostubs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create factory for a database table';
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

        $dir = database_path('factories');

        try {
            $this->createFactory($dir);
            $this->printFilesCreated();
        } catch (MissingTableException $e) {
            $this->error('There were no columns found for this table.');
            $this->error('Please make sure the table name matches the table name in the database');
        }
    }

    protected function createFactory($dir)
    {
        $factory = Factory::create($this->tablename, $this->option('nostubs'));
        $modelname = Table::modelName($this->tablename);
        $this->writeToFile(
            $dir,
            "{$modelname}Factory.php",
            $factory->getFactory()
        );
    }
}
