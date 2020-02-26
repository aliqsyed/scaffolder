<?php

namespace Aliqsyed\Scaffolder\Model;

use Illuminate\Support\Str;
use Aliqsyed\Scaffolder\Table;
use Aliqsyed\Scaffolder\StubsPath;

class Model
{
    use StubsPath;

    protected $table;

    protected $nosetters;

    protected $nocasts;

    protected $nostubs;

    public function __construct($table, $nosetters = false, $nocasts = false, $nostubs = false)
    {
        $this->table = $table;
        $this->nosetters = $nosetters;
        $this->nocasts = $nocasts;
        $this->nostubs = $nostubs;
    }

    public static function create($tablename, $nosetters = false, $nocasts = false, $nostubs = false)
    {
        $table = new Table($tablename);

        return new static($table,$nosetters, $nocasts, $nostubs);
    }

    /**
     * Get the code for the edit and create forms (not fields)
     *
     * @param string
     * @param string
     *
     */
    public function getModel()
    {
        $setters = $this->nosetters ? '' : $this->getAttributeSetters();
        $casts = $this->nocasts ? '' : $this->getCasts();

        return str_replace(
            ['{{casts}}', '{{modelname}}', '{{setters}}'],
            [$casts, $this->table->getModelName(), $setters],
            file_get_contents($this->getStubsPath($this->nostubs) . '/model.stub')
        );
    }

    public function getCasts()
    {
        $casts = '';
        $columns = $this->table->getColumnsWithMetadata();

        foreach ($columns as $column_name => $attributes) {
            if ($attributes['type'] === 'date' || $attributes['type'] === 'datetime') {
                $casts .= "   '$column_name' => 'date:m/d/Y',\n";
            }
        }

        return $casts;
    }

    public function getAttributeSetters()
    {
        $setters = '';
        $columns = $this->table->getColumnsWithMetadata();

        foreach ($columns as $column_name => $attributes) {
            if ($attributes['type'] === 'date' || $attributes['type'] === 'datetime') {
                $setters .= str_replace(
                    ['{{fieldname}}', '{{methodname}}'],
                    [$column_name, 'set' . Str::studly($column_name) . 'Attribute'],
                    file_get_contents($this->getStubsPath($this->nostubs) . '/setdateattribute.stub') . "\n\n"
                );
            }
        }

        return $setters;
    }
}
