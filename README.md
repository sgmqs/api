# openapi-php-sdk

#### 说明
OpenApi PHP SDK

## 安装方法
### 1、推荐使用composer
```bash
composer require openapidemo/openapi-php-sdk
```

### 2、直接引用autoload.php文件

```php
require_once __DIR__ . '/../autoload.php';
```

## 使用方法

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
