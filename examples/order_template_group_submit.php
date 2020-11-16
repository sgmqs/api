<?php

require_once __DIR__ . '/../autoload.php';

use \Ayg\Econtract\Order;

$appId      = env('APP_ID', 'openapitest');
$privateKey = env('PRIVATE_KEY', 'MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAOI4fc5POr0cZmyyGuwAonQGNVUvEd8KWtYk2ozNM1S6la7BK7DwWyk6kI10/NsY+Wues+C0fN86Ol0uckTF+s4NqMqw/W8PZ0HOV0mW1Ew/EV+HT1jRnbYviTRNWx9zS+xRjiDam3VdbElSwPQQulefAlQctcxsT1nPGSbWxvFpAgMBAAECgYEAnG6iGHNTVAh6j3mOAlrh+8d7Q9+bxRd8/w5XDvyrHVE1RrYPx3g+IcF8ykT2wW+Asrn4+07z9s1mJJ+EpygcqOmWtrExQlHjYcAn+27usxhTjWtNZ7AQoF0O0zIIAb8H2dm6Sin2fwvkZORaUy9gMlM7FW/LA48l49ptvs4aTZ0CQQDx5ezsesL8zA3SR+lr8xLTSjJokUOrK5wbYj+SGe+jgkUDxNU53zQXjTKM99rR+4cwomKbMFqGhZzDw1rEmccrAkEA72iYnXAKFHX05TB8YNkcxouwkFpi3rcD7m8LjEcXT/quNvsrcHfJB4iw63H2TwXvUQ4SJrxzjUMwSNkB19zfuwJBAOu6/0ns0Dv+trFndufF92CEe98/QMx8MSLWedDtCYU0HAFyPcCp7V/OL6cEmu/qyHHyrVlCo9VYO87if3/7xAUCQBi98Y/LxW7p5d5NzXzg00V9qEiy3qbvuRtKJKJhsnoUiS6rdIjSCFeb+9TJWVA/Z8UztBKGxVZjDDlrG/KoJAMCQQCRnIyn35lHhj5iXyB2Ofo5wHI45NvPpj7ut3rec58fMLTs3yw5w9OWnOSUCnbZ3gTQHeu4/3Ebu4ozzw4bi2iK');


$order                  = new Order($appId, $privateKey);
$order->templateGroupId = '16';
$order->notifyUrl       = 'http://127.0.0.1:8009/extr/simulator/templategroup-test';


$order->appendListItem(
    $extrOrderId    = get_random_string(16),
    $identity       = '640205197807146953',
    $name           = '史博',
    $identityType   = '0',
    $personalMobile = '13720670113',
    $extrUserId     = null
);

$order->appendListItem(
    $extrOrderId    = get_random_string(16),
    $identity       = '640205198609165576',
    $name           = '唐怡',
    $identityType   = '0',
    $personalMobile = '13720670114',
    $extrUserId     = null
);

$order->appendListItem(
    $extrOrderId    = get_random_string(16),
    $identity       = '640205198706259443',
    $name           = '陶靖',
    $identityType   = '0',
    $personalMobile = '13720670115',
    $extrUserId     = null
);

$res                   = $order->batchTemplateGroupSubmit();
var_dump($res);
