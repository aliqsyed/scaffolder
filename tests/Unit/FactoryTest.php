<?php

namespace Tests\Feature;

use Aliqsyed\Scaffolder\Table;
use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Aliqsyed\Scaffolder\Factory\Factory;
use Aliqsyed\Scaffolder\ScaffolderServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FactoryTest extends TestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    const COLUMNS = [
        'are_you_coming' => [
            'name' => 'are_you_coming',
            'type' => 'boolean',
        ],
        'number_of_items' => [
            'name' => 'number_of_items',
            'type' => 'integer',
        ],
        'start_date' => [
            'name' => 'start_date',
            'type' => 'date',
        ],
        'end_date' => [
            'name' => 'end_date',
            'type' => 'date',
        ],
        'tagged_at' => [
            'name' => 'tagged_at',
            'type' => 'datetime',
        ],
        'first_name' => [
            'name' => 'first_name',
            'type' => 'string',
        ],
        'last_name' => [
            'name' => 'last_name',
            'type' => 'string',
        ],
        'address' => [
            'name' => 'address',
            'type' => 'string',
        ], 'city' => [
            'name' => 'city',
            'type' => 'string',
        ],
        'no_type_here' => [
            'name' => 'no_type_here',
            'type' => 'blob'
        ],
        'state' => [
            'name' => 'state',
            'type' => 'string',
        ], 'zip_code' => [
            'name' => 'zip_code',
            'type' => 'string',
        ],
        'description' => [
            'name' => 'description',
            'type' => 'text',
        ],
        'phone' => [
            'name' => 'phone',
            'type' => 'text',
        ],
        'user_test_id' => [
            'name' => 'user_test_id',
            'type' => 'integer',
        ],
        'user_bigint' => [
            'name' => 'user_test_id',
            'type' => 'bigint',
        ],
        'user_smallint' => [
            'name' => 'user_test_id',
            'type' => 'smallint',
        ],
        'user_tinyint' => [
            'name' => 'user_test_id',
            'type' => 'tinyint',
        ],
        'user_mediumint' => [
            'name' => 'user_test_id',
            'type' => 'mediumint',
        ],
        'email' => [
            'name' => 'email',
            'type' => 'string',
        ],
        'company_url' => [
            'name' => 'company_url',
            'type' => 'string',
        ],
    ];

    protected function getPackageProviders($app)
    {
        return [
            ScaffolderServiceProvider::class,
        ];
    }

    /** @test **/
    public function it_creates_faker_values_for_every_attribute_in_the_model()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getColumnsWithMetadata')->once()->andReturn(static::COLUMNS);
        });

        $factory = new Factory($table, $nostubs = true);

        $fields = $factory->getFactoryFields();

        $this->assertMatchesSnapshot($fields);
    }

    /** @test **/
    public function it_returns_correct_code_for_factory()
    {
        $table = $this->mock(Table::class, function ($mock) {
            $mock->shouldReceive('getColumnsWithMetadata')->twice()->andReturn(static::COLUMNS);
            $mock->shouldReceive('getModelName')->once()->andReturn('Credential');
        });

        $factory = new Factory($table, $nostubs = true);

        $this->assertMatchesSnapshot($factory->getFactory());
    }

    /** @test **/
    public function it_normalizes_the_type_of_faker_field_needed()
    {
        $factory = new Factory(new Table);

        $this->assertSame('first_name', $factory->normalizeType('string', 'student_first_name'));
        $this->assertSame('last_name', $factory->normalizeType('string', 'student_last_name'));
        $this->assertSame('string', $factory->normalizeType('string', 'student_lastname'));
        $this->assertSame('address', $factory->normalizeType('string', 'address'));
        $this->assertSame('city', $factory->normalizeType('string', 'city'));
        $this->assertSame('state', $factory->normalizeType('string', 'state'));
        $this->assertSame('state', $factory->normalizeType('string', 'mailing_state'));
        $this->assertSame('zip', $factory->normalizeType('string', 'zip_code'));
        $this->assertSame('phone', $factory->normalizeType('string', 'phone'));
        $this->assertSame('phone', $factory->normalizeType('string', 'home_phone'));
        $this->assertSame('phone', $factory->normalizeType('string', 'home_phone_number'));
        $this->assertSame('fax', $factory->normalizeType('string', 'fax'));
        $this->assertSame('date', $factory->normalizeType('date', 'birthdate'));
        $this->assertSame('email', $factory->normalizeType('string', 'student_email'));
        $this->assertSame('url', $factory->normalizeType('string', 'company_url'));
    }

    /** @test **/
    public function it_determines_if_a_column_is_foreign_key()
    {
        $factory = new Factory(new Table);

        $this->assertTrue($factory->isForeignKey('credential_id'));
        $this->assertFalse($factory->isForeignKey('credential_id_cred'));
    }

    /** @test **/
    public function it_determines_foreign_key_model_name()
    {
        $factory = new Factory(new Table);

        $this->assertTrue($factory->getForeignKeyModelName('credential_id') === 'Credential');
        $this->assertTrue($factory->getForeignKeyModelName('user_test_id') === 'UserTest');
    }
}
