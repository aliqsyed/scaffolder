<?php

namespace Aliqsyed\Scaffolder\Commands;

use Aliqsyed\Scaffolder\Table;

class CreateAll extends Scaffold
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffolder:all {table} {--force} {--nostubs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all scaffolds for a database table';
    protected const COMMANDS = [
        'scaffolder:controller',
        'scaffolder:factory',
        'scaffolder:model',
        'scaffolder:policy',
        'scaffolder:request',
        'scaffolder:views'
    ];

    protected $tablename;

    /**
     * Execute the console command.
     *
     * @param Table
     *
     * @return void
     */
    public function handle()
    {
        $this->tablename = $this->argument('table');

        foreach (static::COMMANDS as $command) {
            $this->call($command, [
                'table' => $this->tablename,
                '--force' => $this->option('force'),
                '--nostubs' => $this->option('nostubs'),
            ]);
        }
    }
}
