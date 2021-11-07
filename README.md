# iPaymer PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mydevcodes/ ipaymer-php.svg?style=flat-square)](https://packagist.org/packages/mydevcodes/ ipaymer-php)
[![Total Downloads](https://img.shields.io/packagist/dt/mydevcodes/ ipaymer-php.svg?style=flat-square)](https://packagist.org/packages/mydevcodes/ ipaymer-php)
![GitHub Actions](https://github.com/mydevcodes/ ipaymer-php/actions/workflows/main.yml/badge.svg)

Once you complete your iPaymer account there comes a time when you need to connect it to your application. **This package is your best buddy when it comes to integrating iPaymer into your PHP Application.** 
*If your platform is not whitelisted by iPaymer you won't be able to use this library.*

## Installation

You can install the package via composer:

```bash
composer require mydevcodes/ipaymer-php
```

## Usage

The simplest way to call iPaymer PHP:
```php
use Mydevcodes\IpaymerPhp\IpaymerPhp;
IpaymerPhp::init('Your_Secret_Key', 'production|development');
```

### Payment Plans
All your payment plans should be already registred in iPaymer. If a customer is defined only the plans attached to the same payment gateway will be returned.

```php
IpaymerPhp::init('Your_Secret_Key')->plans($customerId);
```

### Create a customer
Creating a customer also requires a subscription and a credit card to be attached.
```php
$customerData = [
    'name' => 'Jimm',
    'email' => 'jimmy@jimmy.com',
    'card' => [
        'name' => 'Jim Doe',
        'number' => '5200828282828210',
        'exp_month' => 10,
        'exp_year' => 2022,
        'cvc' => 123
    ]
];

IpaymerPhp::init('Your_Secret_Key')->create($customerData);
```

### Cancel Plan
Cancels a plan in customers billing cycle
```php
IpaymerPhp::init('Your_Secret_Key')->cancel('_CUSTOMER_ID_', '_PLAN_ID_');
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email tafa@thesocialplus.com instead of using the issue tracker.

## Credits

-   [Mustafe Hyseni](https://github.com/tafhyseni)
-   [Mydev.com](https://github.com/mydevcodes)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.