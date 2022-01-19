## Payright PHP Package.

[![tests](https://github.com/tajulasri/payright-php/actions/workflows/tests.yml/badge.svg)](https://github.com/tajulasri/payright-php/actions/workflows/tests.yml)

This package is used to interacting with Payright payment API using PHP.

## Installation

You can install the package via composer:

```bash
composer require espressobyte/payright-php 
```

### Usage basic

```php
<?php 

use Payright\Client;
use Payright\BearerAuth;
use Payright\Message;
use Payright\Requests\Sms;
use GuzzleHttp\Client as HttpClient;

$payright = Client::make(new HttpClient(),[
    'api_key' => 'secret',
    'sandbox' =>true
]);

$repsonse = $payright->collection('v1')
->create(['name' => 'collection','status' => 'active']);

echo $response->getStatusCode();
echo $response->getBody();

```


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


### Security

If you discover any security related issues, please email mtajulasri@gmail.com instead of using the issue tracker.

