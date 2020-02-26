<?php

namespace Aliqsyed\Scaffolder\Commands;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\Controller\Controller;
use Aliqsyed\Scaffolder\MissingTableException;

class CreateController extends Scaffold
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolder:controller {table} {--force} {--nostubs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create controller for a database table';
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
        $controllers_dir = app_path('Http/Controllers');
        $router_dir = base_path('routes');

        try {
            $this->createController($controllers_dir);
            $this->appendToRoutes($router_dir);
            $this->printFilesCreated();
            $this->printFilesAppended();
        } catch (MissingTableException $e) {
            $this->error('There were no columns found for this table.');
            $this->error('Please make sure the table name matches the table name in the database');
        }
    }

    protected function createController($dir)
    {
        $controller = Controller::create($this->tablename, $this->option('nostubs'));
        $this->writeToFile(
            $dir,
            Table::modelName($this->tablename) . 'Controller.php',
            $controller->getController()
        );
    }

    protected function appendToRoutes($dir)
    {
        $modelvar = Table::modelVariableName($this->tablename);
        $modelname = Table::modelName($this->tablename);

        $this->appendToFile($dir, 'web.php', "\nRoute::resource('" . $modelvar . "', '" . $modelname . "Controller');\n");
    }
}
