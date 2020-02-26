<?php return '<?php

/** @var \\Illuminate\\Database\\Eloquent\\Factory $factory */

use App\\Testuser;
use Faker\\Generator as Faker;
use Carbon\\Carbon;

$factory->define(Testuser::class, function (Faker $faker) {
    return [
      \'name\' => $faker->sentence,
\'my_date\' => (new Carbon($faker->dateTimeBetween(\'this week\', \'+6 days\')->format(\'Y-m-d\')))->format(\'m/d/Y\'),
\'email\' => $faker->unique()->safeEmail,
\'email_verified_at\' => $faker->unique()->safeEmail,
\'password\' => $faker->sentence,
\'attending\' => $faker->boolean($chanceOfGettingTrue = 50),
\'description\' => $faker->paragraphs(3, true),
\'votes\' => $faker->randomDigit,
\'plan_description\' => $faker->paragraphs(3, true),
\'remember_token\' => $faker->sentence,

    ];
});


';
