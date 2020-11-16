# openapi-php-sdk

#### Description
OpenApi PHP SDK

#### Installation

### 1、composer
```bash
composer require openapidemo/openapi-php-sdk
```

### 2、require autoload.php

```php
require_once __DIR__ . '/../autoload.php';
```

#### Instructions

```php

require_once __DIR__ . '/../autoload.php';

use Ayg\Econtract\Order;

...
$order                 = new Order($appId, $privateKey);
$order->templateId     = '...';
$order->notifyUrl      = '...';
$order->extrOrderId    = get_random_string(16);
$order->identity       = '...';
$order->name           = '...';
$order->identityType   = '0';
$order->personalMobile = '...';
$res                   = $order->submit();

...
```
