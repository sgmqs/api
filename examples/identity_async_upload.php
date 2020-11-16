<?php

require_once __DIR__ . '/../autoload.php';

use \Ayg\Econtract\Identity;

$appId      = env('APP_ID', 'openapitest');
$privateKey = env('PRIVATE_KEY', 'MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAJdPEqKtpeE6kbda8nM9Wbaa5z0nAirktkYxEzd41hqC55bo0PTdTQRYs2Olucs2su8omDuyWTKoXgOshjnrcjAaX1qX3JuPTrRcmSaNcPwVOOW0xiw8PHXbbWUKiR6k+fM1IYV9wZI247kHpuhwO2ie0cyMjGJSLPbHuiHK9i+PAgMBAAECgYAKDyq4//xoNeGcJAK8YJbHShMXgLFnMp9fmUGizXjGeG93G/FQZioJoPAELu9kMDXDKpq8VUYS1Riy+9RMo3eK2tuBA28ukRX1veD6ccLk96CiSJJga8a6QVZAAfbcnLd42m3ZtylXcwWVpAsUmJw30vK7z0/oc1vzfMZlixkdgQJBANi9ZJND8u6QcprbVzSBNYav78kYi1ZsLcZlvyGijifogdjtWbGXgGlQJVVBnRcOhhDw0WBejBRCwAIJrD0F1c8CQQCyt4g04d5fumOcGGSLVFK3zh8nvzJtae091euU8ioK9YAOE2BxNOdNEzcAcKfKLJDQl8kNDhBV+zQV5eiR1jpBAkEAwr9SyrxIYbHrOFgUAHqFJPObSp9CPDJR4y3zUn6kqxlQ6yFB8cAGwxofoX6mb1w+fKRWDfiGd4IO0wXr/JzsowJAazR/J0HKlGAJuqxDO/UUPaAOvlgKFuow3yQA0nNF1xcXftoOwzn5+hkpqEDr1fJP2GEEwKkMEZfD0dL9ZOY+QQJBAICdEfAESbehOvGK5j0+rBpHacrUeoaV+31t2OL1B82atSoWq50ggk9SQOmoGVCywVSZgBXFGd4mQLRz4tFmp6g=');


$identity               = new Identity($appId, $privateKey);
$identity->name         = '张无忌';
$identity->identity     = '990723197712298499';
$identity->identityType = '0';
$identity->notifyUrl    = 'http://www.test.com/notify';
$identity->frontfile    = 'E:\idcard-image\ad-front.jpg';
$identity->backfile     = 'E:\idcard-image\dsqbbb.jpg';
$res                    = $identity->asyncUpload();
var_dump($res);
