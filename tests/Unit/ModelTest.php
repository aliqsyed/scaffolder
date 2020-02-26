<?php

namespace Tests\Feature;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Aliqsyed\Scaffolder\Model\Model;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    const COLUMNS = [
        'start_date' => [
            'name' => 'start_date',
            'type' => 'date',
        ],
        'end_date' => [
            'name' => 'end_date',
            'type' => 'date',
        ],
        'tagged_at' => [
            'name' => 'tagged_at',
            'type' => 'datetime',
        ]
    ];

    protected function getPackageProviders($app)
    {
        return [
            ScaffolderServiceProvider::class,
        ];
    }

    /** @test **/
    public function it_creates_setters_for_date_datetime_attributes_correctly()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
        });
        $model = new Model($table, $nosetters = false, $nocasts = false, $nostubs = true);
        $setters = $model->getAttributeSetters(static::COLUMNS, $nostubs = true);

        $this->assertMatchesSnapshot($setters);
    }

    /** @test **/
    public function it_creates_the_casts_array_for_date_datetime_attributes_correctly()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
        });

        $model = new Model($table, $nosetters = false, $nocasts = false, $nostubs = true);

        $casts = $model->getCasts();

        $this->assertStringContainsString("'start_date' => 'date:m/d/Y',", $casts);
        $this->assertStringContainsString("'end_date' => 'date:m/d/Y',", $casts);
        $this->assertStringContainsString("'tagged_at' => 'date:m/d/Y',", $casts);
    }

    /** @test **/
    public function it_does_not_add_non_datetime_field_to_casts_array()
    {
        $columns = array_merge(static::COLUMNS, ['random_number' => [
            'name' => 'random_number',
            'type' => 'integer',
        ]]);

        $table = $this->mock(Table::class, function ($mock) use ($columns) {
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn($columns);
        });

        $model = new Model($table, $nosetters = false, $nocasts = false, $nostubs = true);

        $casts = $model->getCasts($columns);

        $this->assertStringContainsString("'start_date' => 'date:m/d/Y',", $casts);
        $this->assertStringContainsString("'end_date' => 'date:m/d/Y',", $casts);
        $this->assertStringContainsString("'tagged_at' => 'date:m/d/Y',", $casts);
        $this->assertStringNotContainsString("'random_number' => 'date:m/d/Y',", $casts);
    }

    /** @test **/
    public function it_returns_correct_class_code_for_model()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getColumnsWithMetadata')->twice()->andReturn(static::COLUMNS);
            $mock->shouldReceive('getModelName')->once()->andReturn('Credential');
        });

        $model = new Model($table, $nosetters = false, $nocasts = false, $nostubs = true);

        $this->assertMatchesSnapshot($model->getModel());
    }
}
