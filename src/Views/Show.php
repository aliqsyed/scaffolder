<?php

namespace Aliqsyed\Scaffolder\Views;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\StubsPath;

class Show
{
    use StubsPath;

    protected $table;

    protected $nostubs;

    public function __construct(Table $table, $nostubs = false)
    {
        $this->table = $table;
        $this->nostubs = $nostubs;
    }

    public static function create($tablename, $nostubs = false)
    {
        $table = new Table($tablename);

        return new static($table, $nostubs);
    }

    public function getShow()
    {
        return str_replace(
            '{{fields}}',
            $this->getFields(),
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . 'show.stub')
        );
    }

    public function getFields()
    {
        $fields = '';
        $columns = $this->table->getColumnsWithMetadata();
        $modelvar = $this->table->getModelVariableName();

        foreach ($columns as $column_name => $column) {
            $fields .= $this->getField($column, $modelvar);
        }

        return $fields;
    }

    public function getField($column, $modelvar)
    {
        return str_replace(
            ['{{name}}', '{{modelvar}}', '{{friendlyname}}'],
            [$column['name'], $modelvar, $column['friendlyname']],
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . 'showfield.stub')
        );
    }
}
