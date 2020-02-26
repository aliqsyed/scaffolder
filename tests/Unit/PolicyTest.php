<?php

namespace Tests\Unit;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Aliqsyed\Scaffolder\Policy\Policy;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PolicyTest extends TestCase
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
    public function it_unit_returns_correct_class_code_for_policy()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
            $mock->shouldReceive('getModelName')->once()->andReturn('Credential');
        });

        $policy = new Policy($table, $nostubs = true);

        $this->assertMatchesSnapshot($policy->getPolicy());
    }
}
