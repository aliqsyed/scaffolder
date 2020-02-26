<?php

namespace Aliqsyed\Scaffolder\Commands;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\Policy\Policy;
use Aliqsyed\Scaffolder\MissingTableException;

class CreatePolicy extends Scaffold
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolder:policy {table} {--force} {--nostubs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create policy class for a database table';

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
        $policy_dir = app_path('Policy');

        try {
            $this->createPolicy($policy_dir);
            $this->printFilesCreated();
        } catch (MissingTableException $e) {
            $this->error('There were no columns found for this table.');
            $this->error('Please make sure the table name matches the table name in the database');
        }
    }

    protected function createPolicy($dir)
    {
        $this->writeToFile(
            $dir,
            Table::modelName($this->tablename) . 'Policy.php',
            Policy::create(
                $this->tablename,
                $this->option('nostubs')
            )->getPolicy()
        );
    }
}
