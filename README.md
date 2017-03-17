laravel-toolkit
=================


## Versions

This is version 5.0 of the development kit for the Laravel 5.0 framework or higher.

## Installation

To install this update your composer.json file to require

```json
    "agile/laravel-toolkit" : "~5.0"
```
Once the dependencies have been downloaded, add the service provider to your config/app.php file

```php
    'providers' => [
        ...
        Agile\LaravelToolkit\Providers\LaravelToolkitServiceProvider::class
        ...
    ]
```
You are done with the installation!

## How to use

Once installed, use the scaffold provided by the tool kit is very simple, just write in the **artisan console of your project** the following command:

```php artisan make:service "service_name" // Without quotes and in singular```

## Documentation

For documentation on this package, please visit the [wiki](https://github.com/rafni/laravel-toolkit/wiki).

## Change log

Please see the releases page [https://github.com/rafni/laravel-toolkit/releases](https://github.com/rafni/laravel-toolkit/releases)

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email jose at ditecnologia dot com instead of using the issue tracker.

## Credits

- [Alberto Rafael](https://github.com/rafni)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](license.md) for more information.