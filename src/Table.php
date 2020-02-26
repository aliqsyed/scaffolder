<?php

namespace Aliqsyed\Scaffolder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Table
{
    protected $tablename;

    public function __construct($tablename = 'unspecified')
    {
        $this->tablename = $tablename;
    }

    public function checkTableExists()
    {
        if (!Schema::hasTable($this->tablename)) {
            throw new MissingTableException("The {$this->tablename} doesn't exist.");
        }
    }

    public function getColumnNames()
    {
        $this->checkTableExists();

        return array_keys($this->getColumnsWithMetadata($this->tablename));
    }

    public function getColumnsWithMetadata()
    {
        $this->checkTableExists();

        return $this->normalizeColumnsMetadata(DB::getDoctrineSchemaManager()->listTableColumns($this->tablename));
    }

    public function getModelName()
    {
        $this->checkTableExists();

        return static::modelName($this->tablename);
    }

    public static function modelName($tablename)
    {
        return Str::studly(Str::singular($tablename));
    }

    public function getTableName()
    {
        $this->checkTableExists();

        return $this->tablename;
    }

    public function getModelVariableName()
    {
        $this->checkTableExists();

        return static::modelVariableName($this->tablename);
    }

    public static function modelVariableName($tablename)
    {
        return Str::singular($tablename);
    }

    protected function normalizeColumnsMetadata($columns)
    {
        unset($columns['id'], $columns['created_at'], $columns['updated_at'], $columns['deleted_at']);

        return array_map(function ($column) {
            $column = $column->toArray();
            $column['type'] = $column['type']->getName();
            $column['htmlinputtype'] = $this->getHTMLInputType($column['type']);
            $column['required'] = $column['notnull'];
            $column['friendlyname'] = Str::title(str_replace('_', ' ', $column['name']));
            unset($column['notnull']);

            return $column;
        }, $columns);
    }

    protected function getHTMLInputType($fieldtype)
    {
        switch ($fieldtype) {
          case 'integer':
          case 'string':
          case 'date':
          case 'datetime':
            return 'text';
            break;
          case 'text':
            return 'textarea';
            break;
          case 'boolean':
            return 'checkbox';
          default:
            return 'text';
            break;
        }
    }
}
