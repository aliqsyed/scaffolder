<?php

namespace Tests\Feature;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            ScaffolderServiceProvider::class,
        ];
    }

    /** @test **/
    public function it_gets_the_column_names_of_a_database_table()
    {
        $tmd = new Table('testusers');
        $columns = $tmd->getColumnNames();
        $this->assertIsArray($columns);
        //dd($columns);
        $this->assertContains('email', $columns);
        $this->assertContains('name', $columns);
        $this->assertContains('password', $columns);
    }

    /** @test **/
    public function it_gets_the_model_associated_with_database_table()
    {
        $tmd = new Table('testusers');
        $model = $tmd->getModelName();

        $this->assertEquals('Testuser', $model);
    }

    /** @test **/
    public function it_gets_the_model_variable_associated_with_database_table()
    {
        $tmd = new Table('testusers');
        $modelvar = $tmd->getModelVariableName();

        $this->assertEquals('testuser', $modelvar);
    }

    /** @test **/
    public function it_gets_the_column_names_and_types_of_a_database_table()
    {
        $tmd = new Table('testusers');
        $columns = $tmd->getColumnsWithMetadata();
        //dd($columns);
        foreach ($columns as $column_name => $column_attributes) {
            if ($column_name == 'id') {
                $this->assertTrue($column_attributes['autoincrement']);
                $this->assertTrue($column_attributes['type'] == 'integer');
            }

            if (in_array($column_name, ['name', 'password'])) {
                $this->assertFalse($column_attributes['autoincrement']);
                $this->assertEquals('string', $column_attributes['type']);
                $this->assertEquals('text', $column_attributes['htmlinputtype']);
            }

            if (in_array($column_name, ['description', 'plan_description'])) {
                $this->assertFalse($column_attributes['autoincrement']);
                $this->assertEquals('text', $column_attributes['type']);
                $this->assertEquals('textarea', $column_attributes['htmlinputtype']);
            }

            if (in_array($column_name, ['created_at', 'updated_at', 'email_verified_at'])) {
                $this->assertFalse($column_attributes['autoincrement']);
                $this->assertEquals('datetime', $column_attributes['type']);
            }

            if (in_array($column_name, ['my_date'])) {
                $this->assertFalse($column_attributes['autoincrement']);
                $this->assertEquals('date', $column_attributes['type']);
                $this->assertEquals('text', $column_attributes['htmlinputtype']);
            }

            if (in_array($column_name, ['attending'])) {
                $this->assertFalse($column_attributes['autoincrement']);
                $this->assertEquals('boolean', $column_attributes['type']);
                $this->assertEquals('checkbox', $column_attributes['htmlinputtype']);
            }
        }
    }

    /** @test */
    public function it_creates_friendly_name_for_columns()
    {
        $tmd = new Table('testusers');
        $columns = $tmd->getColumnsWithMetadata();

        $this->assertTrue($columns['my_date']['friendlyname'] === 'My Date');
    }
}
