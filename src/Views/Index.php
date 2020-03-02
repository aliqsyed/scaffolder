<?php

namespace Aliqsyed\Scaffolder\Views;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\StubsPath;

class Index
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

    public function getIndex()
    {
        return str_replace(
            ['{{header}}', '{{body}}'],
            [$this->getHeader(), $this->getBody()],
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . 'index.stub')
        );
    }

    public function getHeader()
    {
        return str_replace(
            '{{headerfields}}',
            $this->getHeaderFields(),
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . 'indexheader.stub')
        );
    }

    public function getHeaderFields()
    {
        $fields = '';
        $columns = $this->table->getColumnsWithMetadata();

        foreach ($columns as $column_name => $column) {
            $fields .= str_replace(
                '{{friendlyname}}',
                $column['friendlyname'],
                file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . 'indexheaderfield.stub')
            );
        }

        return $fields;
    }

    public function getBody()
    {
        return str_replace(
            ['{{bodyfields}}', '{{modelvar}}'],
            [$this->getBodyFields(), $this->table->getModelVariableName()],
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . 'indexbody.stub')
        );
    }

    public function getBodyFields()
    {
        $fields = '';
        $columns = $this->table->getColumnsWithMetadata();
        $modelvar = $this->table->getModelVariableName();

        foreach ($columns as $column_name => $column) {
            $fields .= $this->getField($column, $modelvar);
        }

        return str_replace(
            ['{{fields}}'],
            [$fields],
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . 'indexfieldrow.stub')
        );
    }

    public function getField($column, $modelvar)
    {
        return str_replace(
            ['{{name}}', '{{modelvar}}'],
            [$column['name'], $modelvar],
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . 'indexfield.stub')
        );
    }
}
