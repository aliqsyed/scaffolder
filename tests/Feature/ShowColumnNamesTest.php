<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowColumnNamesTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            \Aliqsyed\Scaffolder\ScaffolderServiceProvider::class,
        ];
    }

    /** @test **/
    public function it_shows_the_column_names_of_a_database_table()
    {
        $this->artisan('scaffolder:colnames testusers')
      ->expectsOutput('name')
      ->expectsOutput('email')
      ->assertExitCode(0);
    }
}
