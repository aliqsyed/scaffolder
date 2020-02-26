<?php

namespace Aliqsyed\Scaffolder\Views;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\StubsPath;

class Form
{
    use StubsPath;

    protected $table;

    protected $nostubs;

    protected $type;

    public function __construct($table, $type, $nostubs = false)
    {
        $this->table = $table;
        $this->nostubs = $nostubs;
        $this->type = $type;
    }

    public static function create($tablename, $type, $nostubs = false)
    {
        $table = new Table($tablename);

        return new static($table, $type,  $nostubs);
    }

    /**
     * Get the code for the edit and create forms (not fields)
     *
     * @param string
     * @param string
     *
     */
    public function getForm()
    {
        return str_replace(
            ['{{modelvar}}'],
            [$this->table->getModelVariableName()],
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . $this->type . '.stub')
        );
    }
}
