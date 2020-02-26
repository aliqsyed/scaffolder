<?php

namespace Tests\Feature;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\Controller\Controller;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected function getPackageProviders($app)
    {
        return [
            ScaffolderServiceProvider::class,
        ];
    }

    /** @test **/
    public function it_returns_correct_class_code_for_controller()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
            $mock->shouldReceive('getModelName')->once()->andReturn('Credential');
        });

        $controller = new Controller($table, $nostubs = true);

        $this->assertMatchesSnapshot($controller->getController('credential', 'Credential', $nostubs = true));
    }
}
