# Scaffolder

[![Latest Stable Version](https://poser.pugx.org/aliqsyed/scaffolder/v/stable)](https://packagist.org/packages/aliqsyed/scaffolder)
[![Latest Unstable Version](https://poser.pugx.org/aliqsyed/scaffolder/v/unstable)](https://packagist.org/packages/aliqsyed/scaffolder)
[![Total Downloads](https://poser.pugx.org/aliqsyed/scaffolder/downloads)](https://packagist.org/packages/aliqsyed/scaffolder)
[![License](https://poser.pugx.org/aliqsyed/scaffolder/license)](https://packagist.org/packages/aliqsyed/scaffolder)

## About Scaffolder

This Laravel package scaffolds Controllers, Models, Factories, Policies, Requests and front end blade files for forms (both edit and delete), show and index views.

_This package generates code. Please make sure you read the generated code and make any corrections necessary._

## Compatiblity

This package works with Laravel 6.0 and above.

## Installation

Via Composer

```bash
$ composer require aliqsyed/scaffolder --dev
```

This will add the scaffolder artisan commands to your project.

```bash
php artisan scaffolder:<scaffold-type> [tablename] [--force] [--nostubs]
```

## Usage

You need to create and run a migration for a table. This is a mandatory step since the scoffolds for items listed above are based on the table structure.

Let's say you have created a table called `posts`. You can create scaffolds various scaffolds as follows:

```bash
$ php artisan scaffolder:controller posts
$ php artisan scaffolder:model posts
$ php artisan scaffolder:factory posts
$ php artisan scaffolder:policy posts
$ php artisan scaffolder:request posts
$ php artisan scaffolder:view posts
```

or you can generate all the scaffolds available at once by running the following command:

```bash
$ php artisan scaffolder:all posts
```

All the classes and views generated are copied to their standard Laravel locations.

### Command options

#### --force

Use this option to overwrite an existing file.

#### --nostubs

Use this option to use the stubs that come with the package instead of the onces published. See information below on publishing stubs.

### Additional command options for models only

If you are generating models, you can use these additional options.

#### --nosetters

If you use this option, the model will be created without any setters. By default there are setters for date fields.

#### --nocasts

If you use this option, the model will be created without any casts. By default there are casts for date fields.

## Customizing the code being generated

Use the tag `scaffolder.stubs` to publish stubs.

```bash
$ php artisan vendor:publish --tag=scaffolder.stubs
```

The publishes the stubs for scaffolder to `resources/vendor/aliqsyed/stubs` folder.

Once the stubs are published, you can edit them in any way you want. **Please do not delete any individual files in the stubs folder**.

You can delete the `resources/vendor/aliqsyed/stubs` directory, and the package will go back to using the default stubs that come with the package.

## License

MIT. Please see the [license file](license.md) for more information.
