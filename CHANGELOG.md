# Changelog

All notable changes to ` ipaymer-php` will be documented in this file

## 1.0.0 - 2022-02-01
Released a new method for generating custom invoices
```php
use Mydevcodes\IpaymerPhp\IpaymerPhp;
IpaymerPhp::init('Your_Secret_Key')->generateInvoice('CUSTOMER_IPAYMER_ID', 'PLAN_CODE', 'PRICE', 'QUANTITY');
```

## 0.0.1 - 201X-XX-XX

- initial release
