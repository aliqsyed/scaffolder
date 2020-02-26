<?php

namespace Aliqsyed\Scaffolder\Commands;

use Aliqsyed\Scaffolder\Table;
use Illuminate\Console\Command;

class ShowColumnNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolder:colnames {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show column names for a database table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \Aliqsyed\Scaffolder\Scaffolder
     * @return Array
     */
    public function handle()
    {
        $table = new Table($this->argument('table'));
        $columns = $table->getColumnNames();

        foreach ($columns as $column) {
            $this->info($column);
        }
    }
}
