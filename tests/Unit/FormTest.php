<?php

namespace Tests\Feature;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Aliqsyed\Scaffolder\Views\Form;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
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
    public function it_returns_correct_html_for_create_form()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('testuser');
        });

        $form = new Form($table, 'create', $nostubs = true);

        $this->assertMatchesHtmlSnapshot($form->getForm());
    }

    /** @test **/
    public function it_returns_correct_html_for_edit_form()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getModelVariableName')->once()->andReturn('testuser');
        });

        $form = new Form($table, 'edit', $nostubs = true);

        $this->assertMatchesHtmlSnapshot($form->getForm());
    }
}
