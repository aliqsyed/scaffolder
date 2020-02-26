<?php

namespace Aliqsyed\Scaffolder\Commands;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\StubsPath;
use Aliqsyed\Scaffolder\Views\Form;
use Aliqsyed\Scaffolder\Views\Show;
use Aliqsyed\Scaffolder\Views\Index;
use Aliqsyed\Scaffolder\Views\FormFields;
use Aliqsyed\Scaffolder\MissingTableException;

class CreateViews extends Scaffold
{
    use StubsPath;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolder:views {table} {--force} {--nostubs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create views for a database table';
    protected $tablename;

    /**
     * Execute the console command.
     *
     * @param  \Aliqsyed\Scaffolder\Form
     * @param \Aliqsyed\Scaffolder\Table
     * @param \Aliqsyed\Scaffolder\FormField
     *
     * @return Array
     */
    public function handle()
    {
        $this->tablename = $this->argument('table');

        $dir = resource_path('views/' . Table::modelVariableName($this->tablename));
        try {
            $this->createFormPartial($dir);
            $this->createForm($dir);
            $this->createIndex($dir);
            $this->createShow($dir);
            $this->printFilesCreated();
        } catch (MissingTableException $e) {
            $this->error('There were no columns found for this table.');
            $this->error('Please make sure the table name matches the table name in the database');
        }
    }

    protected function createFormPartial($dir)
    {
        $ff = FormFields::create($this->tablename, $this->option('nostubs'));
        $fields = $ff->getFormFields();

        $this->writeToFile($dir, '_form.blade.php', $fields);
    }

    protected function createForm($dir)
    {
        $form = Form::create($this->tablename, 'create', $this->option('nostubs'));
        $this->writeToFile($dir, 'create.blade.php', $form->getForm());

        $form = Form::create($this->tablename, 'edit', $this->option('nostubs'));
        $this->writeToFile($dir, 'edit.blade.php', $form->getForm());
    }

    protected function createIndex($dir)
    {
        $index = Index::create($this->tablename, $this->option('nostubs'));
        $this->writeToFile($dir, 'index.blade.php', $index->getIndex());
    }

    protected function createShow($dir)
    {
        $show = Show::create($this->tablename, $this->option('nostubs'));
        $this->writeToFile($dir, 'show.blade.php', $show->getShow());
    }
}
