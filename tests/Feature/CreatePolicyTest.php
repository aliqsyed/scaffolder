<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePolicyTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected static $policy_path;

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

        static::$policy_path = app_path('Policy');
        if (is_dir(static::$policy_path) && file_exists(static::$policy_path . '/TestuserPolicy.php')) {
            unlink(static::$policy_path . '/TestuserPolicy.php');
        }
    }

    /** @test **/
    public function it_prompts_before_overwriting_if_policy_exist()
    {
        $this->artisan('scaffolder:policy testusers --force');

        $this->artisan('scaffolder:policy testusers')
             ->expectsQuestion('TestuserPolicy.php already exists in ' . static::$policy_path . '. Do you want to overwrite it?', 'yes')
             ->assertExitCode(0);
    }

    /** @test **/
    public function it_does_not_prompt_before_overwriting_policy_if_force_option_is_used()
    {
        $this->artisan('scaffolder:policy testusers --force')
        ->expectsOutput(static::$policy_path . '/TestuserPolicy.php')
        ->assertExitCode(0);
    }

    /** @test **/
    public function it_shows_an_error_message_while_creating_policy_if_specified_table_doesnt_exist()
    {
        $this->artisan('scaffolder:policy testuserssfwe --force')
             ->expectsOutput('There were no columns found for this table.')
             ->assertExitCode(0);
    }

    /** @test **/
    public function it_creates_the_correct_policy_class_file()
    {
        $this->artisan('scaffolder:policy testusers --force --nostubs');

        $this->assertMatchesSnapshot(file_get_contents(static::$policy_path . '/TestuserPolicy.php'));
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (is_dir(static::$policy_path) && file_exists(static::$policy_path . '/TestuserPolicy.php')) {
            unlink(static::$policy_path . '/TestuserPolicy.php');
        }
    }
}
