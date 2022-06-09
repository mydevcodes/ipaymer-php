# iPaymer PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mydevcodes/ ipaymer-php.svg?style=flat-square)](https://packagist.org/packages/mydevcodes/ ipaymer-php)
[![Total Downloads](https://img.shields.io/packagist/dt/mydevcodes/ ipaymer-php.svg?style=flat-square)](https://packagist.org/packages/mydevcodes/ ipaymer-php)

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

## Methods

### Create a customer
Creating a customer also requires a subscription and a credit card to be attached.
```php
$customerData = [
    'name' => 'Jimm',
    'email' => 'jimmy@jimmy.com'
];

$ipaymer_customer_id = IpaymerPhp::init('Your_Secret_Key')->create($customerData);
```

### Redirection links
These helper methods will construct redirection links to iPaymer for different methods

#### New subscription / Upgrade to package
```php
IpaymerPhp::init('Your_Secret_Key')->checkoutLink('CUSTOMER_IPAYMER_ID', 'PLAN_CODE', 'RETURN_URL');
```

#### New card
```php
IpaymerPhp::init('Your_Secret_Key')->newCardLink('CUSTOMER_IPAYMER_ID');
```

### Assign Plan
Assign a specific plan to a customer. This won't replace any of his previous active plans.
```php
IpaymerPhp::init('Your_Secret_Key')->assign('CUSTOMER_IPAYMER_ID', 'PLAN_ID', 'QUANTITY');
```

### Switch Plan
Replace a specific plan with another. Often used within upgrades/downgrades.
```php
IpaymerPhp::init('Your_Secret_Key')->change('CUSTOMER_IPAYMER_ID', 'FROM_PLAN_ID', 'TO_PLAN_ID');
```

### Payment Plans [DEPRACATED]
All your payment plans should be already registered in iPaymer. If a customer is defined only the plans attached to the same payment gateway will be returned.

```php
IpaymerPhp::init('Your_Secret_Key')->plans($customerId);
```

### Status
Returns customer status on each plan separately. If a customer has 2 plans it will return the status and extra information regarding those plans.
```php
IpaymerPhp::init('Your_Secret_Key')->status('CUSTOMER_IPAYMER_ID');
```

### Invoices
Returns all customer invoices in a descending order
```php
IpaymerPhp::init('Your_Secret_Key')->invoices('CUSTOMER_IPAYMER_ID');
```

### Generate custom invoice
```php
use Mydevcodes\IpaymerPhp\IpaymerPhp;
IpaymerPhp::init('Your_Secret_Key')->generateInvoice('CUSTOMER_IPAYMER_ID', 'PLAN_CODE', 'PRICE', 'QUANTITY', 'DESCRIPTION');
```

### Cancel Plan
Cancels a plan in customers billing cycle
```php
IpaymerPhp::init('Your_Secret_Key')->cancel('CUSTOMER_IPAYMER_ID', 'PACKAGE_CODE');
```

### Remove Card
Removes a card from a customer
```php
IpaymerPhp::init('Your_Secret_Key')->remove('CUSTOMER_IPAYMER_ID', 'IPAYMER_CARD_ID');
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
