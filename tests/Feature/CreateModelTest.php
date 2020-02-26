<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateModelTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected static $model_path;

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

        static::$model_path = app_path();
        if (is_dir(static::$model_path) && file_exists(static::$model_path . '/Testuser.php')) {
            unlink(static::$model_path . '/Testuser.php');
        }
    }

    /** @test **/
    public function it_prompts_before_overwriting_if_model_exist()
    {
        $this->artisan('scaffolder:model testusers --force');

        $this->artisan('scaffolder:model testusers')
             ->expectsQuestion('Testuser.php already exists in ' . static::$model_path . '. Do you want to overwrite it?', 'yes')
             ->assertExitCode(0);
    }

    /** @test **/
    public function it_does_not_prompt_before_overwriting_model_if_force_option_is_used()
    {
        $this->artisan('scaffolder:model testusers --force')
        ->expectsOutput(static::$model_path . '/Testuser.php')
        ->assertExitCode(0);
    }

    /**  @test **/
    public function it_shows_an_error_message_while_creating_model_if_specified_table_doesnt_exist()
    {
        $this->artisan('scaffolder:model testuserssfwe --force')
             ->expectsOutput('There were no columns found for this table.')
             ->assertExitCode(0);
    }

    /** @test * */
    public function it_creates_the_model_file_correctly()
    {
        $this->artisan('scaffolder:model testusers --force --nostubs');
        $this->assertMatchesSnapshot(file_get_contents(static::$model_path . '/Testuser.php'));
    }

    /** @test * */
    public function it_omits_the_casts_if_that_option_is_used()
    {
        $this->artisan('scaffolder:model testusers --force --nocasts --nostubs');
        $this->assertMatchesSnapshot(file_get_contents(static::$model_path . '/Testuser.php'));
    }

    /** @test * */
    public function it_omits_the_setters_for_dates_if_that_option_is_used()
    {
        $this->artisan('scaffolder:model testusers --force  --nosetters --nostubs');
        $this->assertMatchesSnapshot(file_get_contents(static::$model_path . '/Testuser.php'));
    }

    /** @test * */
    public function it_omits_the_setters_for_dates_and_casts_if_both_options_are_used()
    {
        $this->artisan('scaffolder:model testusers --force  --nosetters --nocasts --nostubs');
        $this->assertMatchesSnapshot(file_get_contents(static::$model_path . '/Testuser.php'));
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (is_dir(static::$model_path) && file_exists(static::$model_path . '/Testuser.php')) {
            unlink(static::$model_path . '/Testuser.php');
        }
    }
}
