<?php

namespace Aliqsyed\Scaffolder;

/**
 * This trait adds a method which gets the correct path to stubs
 */
trait StubsPath
{
    public function getStubsPath($nostubs)
    {
        $published_folder = resource_path('vendor/aliqsyed/stubs');
        if ((!$nostubs) && is_dir($published_folder)) {
            return $published_folder;
        }

        return realpath(__DIR__ . '/../stubs');
    }
}
