laravel-toolkit
=================


## Versions

This is version 5.1 of the development kit for the Laravel 5.0 framework or higher.

## Installation

To install this update your composer.json file to require

```json
    "rafni/laravel-toolkit" : "~5.*"
```
Once the dependencies have been downloaded, add the service provider to your config/app.php file

```php
    'providers' => [
        ...
        Rafni\LaravelToolkit\Providers\LaravelToolkitServiceProvider::class
        ...
    ]
```
You are done with the installation!

## How to use

Once installed, use the scaffold provided by the tool kit is very simple, just write in the **artisan console of your project** the following command:

```shell
    php artisan toolkit:package "service_name"
```
Use the command without quotes and in singular. 

In the artisan console, if the process was successful, it will give you the access routes of the new generated resource, copy and paste these routes in the route file corresponding to your version of Laravel.

This will automatically generate the following files in your project:

```
    app/
        Http/
            Controllers/
                NameSpace/
                    ServiceNameController.php
        Repositories/
            NameSpace/
                ServiceNameEloquent.php
                ServiceNameService.php
                ServiceNameContract.php
    resources/
        views/
            NameSpace/
                index.blade.php
                show.blade.php
                create.blade.php
                edit.blade.php
                
```
Finally, in order for the contracts injected in the construction of the controllers do not result in a critical error, you must bind them to the service that will manage the service logic.

In your app/providers/AppServiceProvider.php file, bind them as follows:
```php
    public function register()
    {
        ...
        $this->app->bind(ExampleServiceContract::class, ExampleService::class);
        ...
    }
```

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
