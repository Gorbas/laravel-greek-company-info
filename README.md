# Greek company info via GSIS services
This package performs requests to GSIS and returns company info by provided VAT ID.

## Requirements
- [PHP >= 7.0](https://www.php.net/)
- [Laravel >= 5.5](https://laravel.com/)

## Installation
Require the package with composer.
```shell
composer require gpapakitsos/laravel-greek-company-info
```

Laravel uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.
### Laravel without auto-discovery:
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php
```php
GPapakitsos\GreekCompanyInfo\GreekCompanyInfoServiceProvider::class,
```

#### Copy the package config file to your local config folder with the publish command:
```shell
php artisan vendor:publish --provider="GPapakitsos\GreekCompanyInfo\GreekCompanyInfoServiceProvider"
```
