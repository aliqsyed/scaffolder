<?php

namespace Tests\Feature;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\Views\FormFields;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormFieldTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected function getPackageProviders($app)
    {
        return [
            ScaffolderServiceProvider::class,
        ];
    }

    protected function createFormFieldObject()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('testuser');
        });

        return  new FormFields($table, $nostubs = true);
    }

    /** @test **/
    public function it_returns_correct_html_field_for_the_string_database_field()
    {
        $this->assertMatchesHtmlSnapshot($this->createFormFieldObject()->getFormField([
            'name' => 'full_name',
            'type' => 'string',
            'htmlinputtype' => 'text',
            'friendlyname' => 'Full Name',
            'required' => true,
        ], 'testuser', $nostubs = true));
    }

    /** @test **/
    public function it_returns_correct_html_field_for_the_nullable_string_database_field()
    {
        $formField = $this->createFormFieldObject()->getFormField([
            'name' => 'name',
            'type' => 'string',
            'htmlinputtype' => 'text',
            'friendlyname' => 'Name',
            'required' => false,
        ], 'testuser', $nostubs = true);

        $this->assertMatchesHtmlSnapshot($formField);
    }

    /** @test **/
    public function it_returns_correct_html_field_for_the_longtext_database_field()
    {
        $formField = $this->createFormFieldObject()->getFormField([
            'name' => 'description',
            'type' => 'string',
            'htmlinputtype' => 'textarea',
            'friendlyname' => 'Description',
            'required' => true,
        ], 'testuser', $nostubs = true);

        $this->assertMatchesHtmlSnapshot($formField);
    }

    /** @test **/
    public function it_returns_correct_html_field_for_the_boolean_database_field()
    {
        $formField = $this->createFormFieldObject()->getFormField([
            'name' => 'interested',
            'type' => 'boolean',
            'htmlinputtype' => 'checkbox',
            'friendlyname' => 'Interested',
            'required' => true,
        ], 'testuser', $nostubs = true);

        $this->assertMatchesHtmlSnapshot($formField);
    }
}
