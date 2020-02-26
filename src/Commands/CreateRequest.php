<?php

namespace Aliqsyed\Scaffolder\Commands;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\Request\Request;
use Aliqsyed\Scaffolder\MissingTableException;

class CreateRequest extends Scaffold
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolder:request {table} {--force} {--nostubs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a FormRequest object for a database table';
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
        $dir = app_path('Http/Requests');

        try {
            $this->createRequest($dir);
            $this->printFilesCreated();
        } catch (MissingTableException $e) {
            $this->error('There were no columns found for this table.');
            $this->error('Please make sure the table name matches the table name in the database');
        }
    }

    protected function createRequest($dir)
    {
        $request = Request::create($this->tablename, $this->option('nostubs'));
        $this->writeToFile(
            $dir,
            Table::modelName($this->tablename) . 'Request.php',
            $request->getRequest()
        );
    }
}
