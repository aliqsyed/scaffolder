<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateControllerTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected static $controller_path;

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
        static::$controller_path = app_path('Http/Controllers');
        if (file_exists(static::$controller_path . '/TestuserController.php')) {
            unlink(static::$controller_path . '/TestuserController.php');
        }
    }

    /** @test * */
    public function it_prompts_before_overwriting_if_controller_exist()
    {
        $this->artisan('scaffolder:controller testusers --force');

        $this->artisan('scaffolder:controller testusers')
            ->expectsQuestion('TestuserController.php already exists in ' . static::$controller_path . '. Do you want to overwrite it?', 'yes')
            ->assertExitCode(0);
    }

    /** @test * */
    public function it_does_not_prompt_before_overwriting_controller_if_force_option_is_used()
    {
        $this->artisan('scaffolder:controller testusers --force')
            ->expectsOutput(static::$controller_path . '/TestuserController.php')
            ->assertExitCode(0);
    }

    /* @test * */
    public function it_adds_the_route_for_the_controller()
    {
        $this->artisan('scaffolder:controller testusers --force');
        $routes = file_get_contents(base_path() . '/routes/web.php');
        $this->assertStringContainsString("Route::resource('testuser', 'TestuserController');", $routes);
    }

    /** @test * */
    public function it_shows_an_error_message_while_creating_controller_if_specified_table_doesnt_exist()
    {
        $this->artisan('scaffolder:controller testuserssfwe --force')
            ->expectsOutput('There were no columns found for this table.')
            ->assertExitCode(0);
    }

    /** @test * */
    public function it_creates_the_correct_controller_file()
    {
        $this->artisan('scaffolder:controller testusers --force --nostubs');

        $this->assertMatchesSnapshot(file_get_contents(static::$controller_path . '/TestuserController.php'));
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (file_exists(static::$controller_path . '/TestuserController.php')) {
            unlink(static::$controller_path . '/TestuserController.php');
        }
    }
}
