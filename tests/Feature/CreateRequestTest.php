<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateRequestTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected static $path;

    protected function getPackageProviders($app)
    {
        return [
            ScaffolderServiceProvider::class,
        ];
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->app->setBasePath(realpath(__DIR__ . '/../../testfs'));

        static::$path = app_path('Http/Requests');
        if (file_exists(static::$path . '/TestuserRequest.php')) {
            unlink(static::$path . '/TestuserRequest.php');
        }
    }

    /** @test **/
    public function it_prompts_before_overwriting_if_request_exists()
    {
        $this->artisan('scaffolder:request testusers --force --nostubs');

        $this->artisan('scaffolder:request testusers --nostubs')
             ->expectsQuestion('TestuserRequest.php already exists in ' . static::$path . '. Do you want to overwrite it?', 'yes')
             ->assertExitCode(0);
    }

    /** @test **/
    public function it_does_not_prompt_before_overwriting_request_if_force_option_is_used()
    {
        $this->artisan('scaffolder:request testusers --force --nostubs')
        ->expectsOutput(static::$path . '/TestuserRequest.php')
        ->assertExitCode(0);
    }

    /* @test **/
    public function it_shows_an_error_message_while_creating_request_if_specified_table_doesnt_exist()
    {
        $this->artisan('scaffolder:request testusersfwerwes --force --nostubs')
             ->expectsOutput('There were no columns found for this table.')
             ->assertExitCode(0);
    }

    /** @test **/
    public function it_creates_the_correct_request_file()
    {
        $this->artisan('scaffolder:request testusers --force --nostubs');

        $this->assertMatchesSnapshot(file_get_contents(static::$path . '/TestuserRequest.php'));
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (file_exists(static::$path . '/TestuserRequest.php')) {
            unlink(static::$path . '/TestuserRequest.php');
        }
    }
}
