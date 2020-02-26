<?php

namespace Aliqsyed\Scaffolder\Policy;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\StubsPath;

class Policy
{
    use StubsPath;
    protected $table;
    protected $nostubs;

    public function __construct(Table $table, $nostubs = false)
    {
        $this->table = $table;
        $this->nostubs = $nostubs;
    }

    public static function create($tablename, $nostubs)
    {
        $table = new Table($tablename);

        return new static($table, $nostubs);
    }

    /**
     * Get the code for the edit and create forms (not fields)
     *
     * @param string
     * @param string
     *
     */
    public function getPolicy()
    {
        return str_replace(
            ['{{modelvar}}', '{{modelname}}'],
            [
                $this->table->getModelVariableName(),
                $this->table->getModelName()
            ],
            file_get_contents($this->getStubsPath($this->nostubs) . '/policy.stub')
        );
    }
}
