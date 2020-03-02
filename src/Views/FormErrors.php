<?php

namespace Aliqsyed\Scaffolder\Views;

use Aliqsyed\Scaffolder\StubsPath;

class FormErrors
{
    use StubsPath;

    protected $nostubs;

    public function __construct($nostubs = false)
    {
        $this->nostubs = $nostubs;
    }

    public static function create($nostubs = false)
    {
        return new static($nostubs);
    }

    /**
     * Get the code for the edit and create forms (not fields)
     *
     * @param string
     * @param string
     *
     */
    public function getErrorDisplay()
    {
        return file_get_contents($this->getStubsPath($this->nostubs) . '/view/_errors.stub');
    }
}
