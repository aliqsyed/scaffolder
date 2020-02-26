<?php

namespace Tests\Feature;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Aliqsyed\Scaffolder\Request\Request as RequestScaffold;

class RequestTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    const COLUMNS = [
        'are_you_coming' => [
            'name' => 'are_you_coming',
            'type' => 'boolean',
            'required' => true,
        ],
        'number_of_items' => [
            'name' => 'number_of_items',
            'type' => 'integer',
            'required' => true,
        ],
        'start_date' => [
            'name' => 'start_date',
            'type' => 'date',
            'required' => true,
        ],
        'end_date' => [
            'name' => 'end_date',
            'type' => 'date',
            'required' => true,
        ],
        'tagged_at' => [
            'name' => 'tagged_at',
            'type' => 'datetime',
            'required' => true,
        ],
        'first_name' => [
            'name' => 'first_name',
            'type' => 'string',
            'required' => true,
        ],
        'last_name' => [
            'name' => 'last_name',
            'type' => 'string',
            'required' => true,
        ],
        'address' => [
            'name' => 'address',
            'type' => 'string',
            'required' => true,
        ],
        'city' => [
            'name' => 'city',
            'type' => 'string',
            'required' => false,
        ],
        'no_type_here' => [
            'name' => 'no_type_here',
            'type' => 'blob',
            'required' => false,
        ],
        'state' => [
            'name' => 'state',
            'type' => 'string',
            'required' => true,
        ],
        'zip_code' => [
            'name' => 'zip_code',
            'type' => 'string',
            'required' => false,
        ],
        'description' => [
            'name' => 'description',
            'type' => 'text',
            'required' => false,
        ],
        'phone' => [
            'name' => 'phone',
            'type' => 'text',
            'required' => false,
        ],
        'user_test_id' => [
            'name' => 'user_test_id',
            'type' => 'integer',
            'required' => false,
        ],
        'email' => [
            'name' => 'email',
            'type' => 'string',
            'required' => false,
        ]
    ];

    protected function getPackageProviders($app)
    {
        return [
            ScaffolderServiceProvider::class,
        ];
    }

    /** @test **/
    public function it_creates_rules_for_every_attribute_in_the_model()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
        });

        $request = new RequestScaffold($table, $nostubs = true);

        $rules = $request->getRules();

        $this->assertMatchesSnapshot($rules);
    }

    /** @test **/
    public function it_returns_correct_code_for_request()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
            $mock->shouldReceive('getModelName')->once()->andReturn('Credential');
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
        });

        $request = new RequestScaffold($table, $nostubs = true);

        $this->assertMatchesSnapshot($request->getRequest());
    }
}
