<?php

namespace Aliqsyed\Scaffolder\Views;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\StubsPath;

class FormFields
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

    public function getFormFields()
    {
        $fields = '';
        $columns = $this->table->getColumnsWithMetadata();

        foreach ($columns as $column_name => $column) {
            $fields .= $this->getFormField($column);
        }

        return $fields;
    }

    public function getFormField($column)
    {
        $required = $column['required'] ? ' required' : '';
        $askterisk = $column['required'] ? ' required' : '';

        return str_replace(
            ['{{name}}', '{{required}}', '{{friendlyname}}', '{{modelvar}}', '{{asterisk}}'],
            [$column['name'], $required, $column['friendlyname'], $this->table->getModelVariableName(), $askterisk],
            file_get_contents($this->getStubsPath($this->nostubs) . '/view/' . $column['htmlinputtype'] . '.stub')
        );
    }
}
