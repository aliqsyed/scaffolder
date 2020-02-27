<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;
use Aliqsyed\Scaffolder\FileWriter;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileWriterTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;
    public static $path = '';

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
        static::$path = base_path('routes');
        copy(static::$path . '/web.php.backup', static::$path . '/web.php');
    }

    /** @test **/
    public function it_does_not_append_to_file_if_the_text_already_exists()
    {
        $fw = new FileWriter;
        $content = "Route::resource('testuser', 'TestuserController');";
        $this->assertFalse($fw->appendToFile(static::$path, 'web.php', $content));
    }

    /** @test **/
    public function it_does_append_to_file_if_the_text_does_not_already_exist()
    {
        $fw = new FileWriter;
        $content = "\nRoute::resource('testuser'" . generateRandomString() . ", 'TestuserController');\n";
        $this->assertTrue($fw->appendToFile(static::$path, 'web.php', $content));
    }

    public function tearDown():void
    {
        parent::tearDown();
        unlink(static::$path . '/web.php');
    }
}

function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}
