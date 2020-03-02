<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\Views\FormErrors;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormErrorsTest extends TestCase
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
    public function it_returns_correct_html_for_displaying_errors()
    {
        $errors = new FormErrors($nostubs = true);

        $this->assertMatchesHtmlSnapshot($errors->getErrorDisplay());
    }
}
