<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateFactoryTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected static $factory_path;

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
        static::$factory_path = database_path('factories');
        if (is_dir(static::$factory_path) && file_exists(static::$factory_path . '/TestuserFactory.php')) {
            unlink(static::$factory_path . '/TestuserFactory.php');
        }
    }

    /** @test **/
    public function it_prompts_before_overwriting_if_factory_exist()
    {
        $this->artisan('scaffolder:factory testusers --force');

        $this->artisan('scaffolder:factory testusers')
             ->expectsQuestion('TestuserFactory.php already exists in ' . static::$factory_path . '. Do you want to overwrite it?', 'yes')
             ->assertExitCode(0);
    }

    /** @test **/
    public function it_does_not_prompt_before_overwriting_factory_if_force_option_is_used()
    {
        $this->artisan('scaffolder:factory testusers --force')
        ->expectsOutput(static::$factory_path . '/TestuserFactory.php')
        ->assertExitCode(0);
    }

    /** @test **/
    public function it_shows_an_error_message_while_creating_factory_if_specified_table_doesnt_exist()
    {
        $this->artisan('scaffolder:factory testuserssfwe --force')
             ->expectsOutput('There were no columns found for this table.')
             ->assertExitCode(0);
    }

    /** @test **/
    public function it_creates_the_factory_file_correctly()
    {
        $this->artisan('scaffolder:factory testusers --force --nostubs');
        $this->assertMatchesSnapshot(file_get_contents(static::$factory_path . '/TestuserFactory.php'));
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (is_dir(static::$factory_path) && file_exists(static::$factory_path . '/Testuser.php')) {
            unlink(static::$factory_path . '/Testuser.php');
        }
    }
}
