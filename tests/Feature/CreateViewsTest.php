<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateViewsTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected static $resource_path;
    protected static $errors_path;

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

        static::$resource_path = resource_path('views/testuser');
        static::$errors_path = resource_path('views/shared');

        if (is_dir(static::$resource_path)) {
            exec('rm -rf ' . static::$resource_path);
        }

        if (is_dir(static::$errors_path)) {
            exec('rm -rf ' . static::$errors_path);
        }
    }

    /** @test **/
    public function it_prompts_before_overwriting_if_files_exist()
    {
        $this->artisan('scaffolder:views testusers');

        $this->artisan('scaffolder:views testusers')
      ->expectsQuestion('_form.blade.php already exists in ' . static::$resource_path . '. Do you want to overwrite it?', 'yes')
      ->expectsQuestion('create.blade.php already exists in ' . static::$resource_path . '. Do you want to overwrite it?', 'yes')
      ->expectsQuestion('edit.blade.php already exists in ' . static::$resource_path . '. Do you want to overwrite it?', 'yes')
      ->expectsQuestion('_errors.blade.php already exists in ' . static::$errors_path . '. Do you want to overwrite it?', 'yes')
      ->expectsQuestion('index.blade.php already exists in ' . static::$resource_path . '. Do you want to overwrite it?', 'yes')
      ->expectsQuestion('show.blade.php already exists in ' . static::$resource_path . '. Do you want to overwrite it?', 'yes')
      ->assertExitCode(0);
    }

    /** @test **/
    public function it_does_not_prompt_before_overwriting_if_force_option_is_used()
    {
        $this->artisan('scaffolder:views testusers --force')
      ->expectsOutput(static::$resource_path . '/_form.blade.php')
      ->expectsOutput(static::$resource_path . '/create.blade.php')
      ->expectsOutput(static::$resource_path . '/edit.blade.php')
      ->expectsOutput(static::$errors_path . '/_errors.blade.php')
      ->expectsOutput(static::$resource_path . '/index.blade.php')
      ->expectsOutput(static::$resource_path . '/show.blade.php')
      ->assertExitCode(0);
    }

    /** @test **/
    public function it_creates_the_view_files_with_correct_html()
    {
        $this->artisan('scaffolder:views testusers --force');
        $this->assertMatchesSnapshot(file_get_contents(static::$resource_path . '/_form.blade.php'));
        $this->assertMatchesSnapshot(file_get_contents(static::$resource_path . '/create.blade.php'));
        $this->assertMatchesSnapshot(file_get_contents(static::$resource_path . '/edit.blade.php'));
        $this->assertMatchesSnapshot(file_get_contents(static::$errors_path . '/_errors.blade.php'));
        $this->assertMatchesSnapshot(file_get_contents(static::$resource_path . '/index.blade.php'));
        $this->assertMatchesSnapshot(file_get_contents(static::$resource_path . '/show.blade.php'));
    }

    /** @test **/
    public function it_shows_an_error_message_if_specified_table_doesnt_exist()
    {
        $this->artisan('scaffolder:views testuserssfwe --force')
      ->expectsOutput('There were no columns found for this table.')
      ->assertExitCode(0);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        if (is_dir(static::$resource_path)) {
            exec('rm -rf ' . static::$resource_path);
        }
    }

    public function files_present($files)
    {
        foreach ($files as $filename) {
            if (!file_exists(static::$resource_path . "/$filename")) {
                return false;
            }
        }

        return true;
    }
}
