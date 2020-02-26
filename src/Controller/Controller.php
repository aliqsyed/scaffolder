<?php

namespace Aliqsyed\Scaffolder\Controller;

use Aliqsyed\Scaffolder\Table;
use  Aliqsyed\Scaffolder\StubsPath;

class Controller
{
    use StubsPath;

    protected $table;

    protected $nostubs;

    public function __construct($table, $nostubs = false)
    {
        $this->table = $table;

        $this->nostubs = $nostubs;
    }

    public static function create($tablename, $nostubs = false)
    {
        $table = new Table($tablename);

        return new static($table, $nostubs);
    }

    /**
     * Get the code for the Controller
     *
     * @return string
     */
    public function getController()
    {
        return str_replace(
            ['{{modelvar}}', '{{modelname}}'],
            [$this->table->getModelVariableName(), $this->table->getModelName()],
            file_get_contents($this->getStubsPath($this->nostubs) . '/controller.stub')
        );
    }
}
