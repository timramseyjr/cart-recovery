# Cart Recovery

[![Build Status](https://travis-ci.org/timramseyjr/cart-recovery.svg?branch=master)](https://travis-ci.org/timramseyjr/cart-recovery)
[![styleci](https://styleci.io/repos/CHANGEME/shield)](https://styleci.io/repos/CHANGEME)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/timramseyjr/cart-recovery/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/timramseyjr/cart-recovery/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/CHANGEME/mini.png)](https://insight.sensiolabs.com/projects/CHANGEME)
[![Coverage Status](https://coveralls.io/repos/github/timramseyjr/cart-recovery/badge.svg?branch=master)](https://coveralls.io/github/timramseyjr/cart-recovery?branch=master)

[![Packagist](https://img.shields.io/packagist/v/timramseyjr/cart-recovery.svg)](https://packagist.org/packages/timramseyjr/cart-recovery)
[![Packagist](https://poser.pugx.org/timramseyjr/cart-recovery/d/total.svg)](https://packagist.org/packages/timramseyjr/cart-recovery)
[![Packagist](https://img.shields.io/packagist/l/timramseyjr/cart-recovery.svg)](https://packagist.org/packages/timramseyjr/cart-recovery)

Package description: CHANGE ME

## Installation

Install via composer
```bash
composer require timramseyjr/cart-recovery
```

### Register Service Provider

**Note! This and next step are optional if you use laravel>=5.5 with package
auto discovery feature.**

Add service provider to `config/app.php` in `providers` section
```php
timramseyjr\CartRecovery\ServiceProvider::class,
```

### Register Facade

Register package facade in `config/app.php` in `aliases` section
```php
timramseyjr\CartRecovery\Facades\CartRecovery::class,
```

### Publish Configuration File

```bash
php artisan vendor:publish --provider="timramseyjr\CartRecovery\ServiceProvider" --tag="config"
```

## Usage

CHANGE ME

## Security

If you discover any security related issues, please email tim@truelightdesigns.com
instead of using the issue tracker.

## Credits

- [Tim Ramsey](https://github.com/timramseyjr/cart-recovery)
- [All contributors](https://github.com/timramseyjr/cart-recovery/graphs/contributors)

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
