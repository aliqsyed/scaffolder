<?php

namespace Aliqsyed\Scaffolder\Factory;

use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\StubsPath;

class Factory
{
    use StubsPath;
    /**
     * Special types which have seperate stubs for them. If these appear in a field's name
     * their value comes from a stub that named accordingly.
     */
    const SPECIAL_TYPES = ['first_name', 'last_name', 'address', 'city', 'state', 'zip', 'phone', 'fax', 'email', 'url'];

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

    /**
     * Scaffold a factory
     *
     * @param array $columns
     * @param string $modelname
     * @return string
     */
    public function getFactory()
    {
        $columns = $this->table->getColumnsWithMetadata();
        $factory_fields = $this->getFactoryFields($columns);

        return str_replace(
            ['{{factoryfields}}', '{{modelname}}'],
            [$factory_fields, $this->table->getModelName()],
            file_get_contents($this->getStubsPath($this->nostubs) . '/factory.stub')
        );
    }

    public function getFactoryFields()
    {
        $fields = '';
        $columns = $this->table->getColumnsWithMetadata();

        foreach ($columns as $column_name => $attributes) {
            if (in_array($attributes['type'], ['date', 'datetime', 'timestamp'])) {
                $fields .= $this->getField('date', $column_name);
            } elseif (in_array($attributes['type'], ['string'])) {
                $fields .= $this->getField('string', $column_name);
            } elseif (in_array($attributes['type'], ['text'])) {
                $fields .= $this->getField('text', $column_name);
            } elseif (in_array($attributes['type'], ['integer'])) {
                $fields .= $this->getField('integer', $column_name);
            } elseif (in_array($attributes['type'], ['boolean'])) {
                $fields .= $this->getField('boolean', $column_name);
            } else {
                $fields .= $this->getField('unknown', $column_name);
            }
        }

        return $fields;
    }

    public function getField($type, $name)
    {
        $type = $this->normalizeType($type, $name);

        if ($type === 'foreign_key') {
            return  str_replace(
                ['{{fieldname}}', '{{modelname}}'],
                [$name, $this->getForeignKeyModelName($name)],
                file_get_contents($this->getStubsPath($this->nostubs) . '/factory/foreign_key.stub')
            ) . "\n";
        }

        return  str_replace(
            ['{{fieldname}}'],
            [$name],
            file_get_contents($this->getStubsPath($this->nostubs) . "/factory/$type.stub")
        ) . "\n";
    }

    public function isForeignKey($name)
    {
        return preg_match('/.+_id$/', $name) === 1;
    }

    public function getForeignKeyModelName($name)
    {
        preg_match('/(.+)_id$/', $name, $matches);

        return \Illuminate\Support\Str::studly($matches[1]) ;
    }

    public function normalizeType($type, $name)
    {
        if ($this->isForeignKey($name)) {
            return 'foreign_key';
        }
        foreach (static::SPECIAL_TYPES as $special_type) {
            if (strpos($name, $special_type) !== false) {
                return $special_type;
            }
        }

        return $type;
    }
}
