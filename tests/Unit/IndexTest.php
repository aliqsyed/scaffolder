<?php

namespace Tests\Unit;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Aliqsyed\Scaffolder\Views\Index;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    const COLUMNS = [
        'are_you_coming' => [
            'name' => 'are_you_coming',
            'type' => 'boolean',
            'required' => true,
            'friendlyname' => 'Are you coming'
        ],
        'number_of_items' => [
            'name' => 'number_of_items',
            'type' => 'integer',
            'required' => true,
            'friendlyname' => 'Number of items'
        ],
        'start_date' => [
            'name' => 'start_date',
            'type' => 'date',
            'required' => true,
            'friendlyname' => 'Start Date',
        ],
        'end_date' => [
            'name' => 'end_date',
            'type' => 'date',
            'required' => true,
            'friendlyname' => 'End Date',
        ],
        'tagged_at' => [
            'name' => 'tagged_at',
            'type' => 'datetime',
            'required' => true,
            'friendlyname' => 'Tagged At',
        ],
        'first_name' => [
            'name' => 'first_name',
            'type' => 'string',
            'required' => true,
            'friendlyname' => 'First Name',
        ],
        'last_name' => [
            'name' => 'last_name',
            'type' => 'string',
            'required' => true,
            'friendlyname' => 'Last Name',
        ],
        'address' => [
            'name' => 'address',
            'type' => 'string',
            'required' => true,
            'friendlyname' => 'Address',
        ],
        'city' => [
            'name' => 'city',
            'type' => 'string',
            'required' => false,
            'friendlyname' => 'City',
        ],
        'no_type_here' => [
            'name' => 'no_type_here',
            'type' => 'blob',
            'required' => false,
            'friendlyname' => 'No Type Here',
        ],
        'state' => [
            'name' => 'state',
            'type' => 'string',
            'required' => true,
            'friendlyname' => 'State',
        ],
        'zip_code' => [
            'name' => 'zip_code',
            'type' => 'string',
            'required' => false,
            'friendlyname' => 'Zip Code',
        ],
        'description' => [
            'name' => 'description',
            'type' => 'text',
            'required' => false,
            'friendlyname' => 'Description',
        ],
        'phone' => [
            'name' => 'phone',
            'type' => 'text',
            'required' => false,
            'friendlyname' => 'Phone',
        ],
        'user_test_id' => [
            'name' => 'user_test_id',
            'type' => 'integer',
            'required' => false,
            'friendlyname' => 'User Test Id',
        ],
        'email' => [
            'name' => 'email',
            'type' => 'string',
            'required' => false,
            'friendlyname' => 'Email',
        ]
    ];

    protected function getPackageProviders($app)
    {
        return [
            ScaffolderServiceProvider::class,
        ];
    }

    /** @test **/
    public function it_returns_correct_code_for_column_value_in_index()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
        });

        $index = new Index($table, $nostubs = true);

        $this->assertMatchesSnapshot($index->getField([
            'name' => 'number_of_items',
            'type' => 'integer',
            'required' => true,
        ], $table->getModelVariableName()));
    }

    /** @test **/
    public function it_returns_correct_code_for_body_fields_in_index()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
        });

        $index = new Index($table, $nostubs = true);

        $this->assertMatchesSnapshot($index->getBodyFields());
    }

    /** @test **/
    public function it_returns_correct_code_for_body_in_index()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
        });

        $index = new Index($table, $nostubs = true);

        $this->assertMatchesSnapshot($index->getBody());
    }

    /** @test **/
    public function it_returns_correct_code_for_header_fields_in_index()
    {
        $table = $this->mock(Table::class, function ($mock) {
            //$mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
        });

        $index = new Index($table, $nostubs = true);

        $this->assertMatchesSnapshot($index->getHeaderFields());
    }

    /** @test **/
    public function it_returns_correct_code_for_table_header_in_index()
    {
        $table = $this->mock(Table::class, function ($mock) {
            //$mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
        });

        $index = new Index($table, $nostubs = true);

        $this->assertMatchesSnapshot($index->getHeader());
    }

    /** @test **/
    public function it_returns_correct_code_for_table_in_index()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('credential');
            $mock->shouldReceive('getColumnsWithMetadata')->twice()->andReturn(static::COLUMNS);
        });

        $index = new Index($table, $nostubs = true);

        $this->assertMatchesSnapshot($index->getIndex());
    }
}
