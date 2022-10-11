# Wedos API client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jakuborava/wapi.svg?style=flat-square)](https://packagist.org/packages/jakuborava/wapi)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/jakuborava/wapi/run-tests?label=tests)](https://github.com/jakuborava/wapi/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/jakuborava/wapi/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/jakuborava/wapi/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jakuborava/wapi.svg?style=flat-square)](https://packagist.org/packages/jakuborava/wapi)

Client for Wedos API

## Installation

You can install the package via composer:

```bash
composer require jakuborava/wapi
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="wapi-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$wedosAPI = new Jakuborava\WedosAPI();
echo $wedosAPI->echoPhrase('Hello, Jakuborava!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [jakuborava](https://github.com/jakuborava)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
