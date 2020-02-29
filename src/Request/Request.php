<?php

namespace Aliqsyed\Scaffolder\Request;

use Aliqsyed\Scaffolder\Table;
use  Aliqsyed\Scaffolder\StubsPath;

class Request
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
     * Get the code for the edit and create forms (not fields)
     *
     * @param string
     * @param string
     *
     */
    public function getRequest()
    {
        return str_replace(
            ['{{modelvar}}', '{{modelname}}', '{{modelrules}}'],
            [$this->table->getModelVariableName(), $this->table->getModelName(), $this->getRules()],
            file_get_contents($this->getStubsPath($this->nostubs) . '/request.stub')
        );
    }

    public function getRules()
    {
        $rules = '';
        $columns = $this->table->getColumnsWithMetadata();

        foreach ($columns as $column_name => $attributes) {
            $rules .= "'$column_name' => '";
            $rules .= $attributes['required'] ? 'required' : 'nullable';
            if ($attributes['type'] === 'string') {
                $rules .= strpos($attributes['name'], 'email') !== false ? '|email' : '';
                $rules .= strpos($attributes['name'], 'url') !== false ? '|url' : '';
            }

            if (in_array($attributes['type'], ['integer', 'bigint', 'smallint', 'tinyint', 'mediumint'])) {
                $rules .= '|numeric';
            }
            $rules .= strpos($attributes['type'], 'date') !== false ? '|date' : '';
            $rules .= $attributes['type'] === 'boolean' ? '|boolean' : '';
            $rules .= "',\n";
        }

        return $rules;
    }
}
