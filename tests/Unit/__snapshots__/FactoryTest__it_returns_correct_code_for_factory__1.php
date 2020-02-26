<?php return '<?php

/** @var \\Illuminate\\Database\\Eloquent\\Factory $factory */

use App\\Credential;
use Faker\\Generator as Faker;
use Carbon\\Carbon;

$factory->define(Credential::class, function (Faker $faker) {
    return [
      \'are_you_coming\' => $faker->boolean($chanceOfGettingTrue = 50),
\'number_of_items\' => $faker->randomDigit,
\'start_date\' => (new Carbon($faker->dateTimeBetween(\'this week\', \'+6 days\')->format(\'Y-m-d\')))->format(\'m/d/Y\'),
\'end_date\' => (new Carbon($faker->dateTimeBetween(\'this week\', \'+6 days\')->format(\'Y-m-d\')))->format(\'m/d/Y\'),
\'tagged_at\' => (new Carbon($faker->dateTimeBetween(\'this week\', \'+6 days\')->format(\'Y-m-d\')))->format(\'m/d/Y\'),
\'first_name\' => $faker->firstName,
\'last_name\' => $faker->lastName,
\'address\' => $faker->streetAddress,
\'city\' => $faker->city,
//\'no_type_here\' => $faker->,
//unknown type see https://github.com/fzaninotto/Faker to enter manually.
\'state\' => $faker->stateAbbr,
\'zip_code\' => $faker->postCode,
\'description\' => $faker->paragraphs(3, true),
\'phone\' => $faker->phoneNumber,
\'user_test_id\' => function () {
  return (factory(App\\UserTest::class)->create())->id;
},
\'email\' => $faker->unique()->safeEmail,

    ];
});


';
