<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

$PhoneFormatter = new Joart\PhoneFormatter\PhoneFormatter();
var_dump($PhoneFormatter->change('15345678')) . PHP_EOL;
var_dump($PhoneFormatter->change('1012345678')) . PHP_EOL;
var_dump($PhoneFormatter->change('7012345678')) . PHP_EOL;
var_dump($PhoneFormatter->change('7050562800')) . PHP_EOL;
var_dump($PhoneFormatter->change('02-2064-8801')) . PHP_EOL;
var_dump($PhoneFormatter->change('02-2064-8801/2')) . PHP_EOL;
var_dump($PhoneFormatter->change('02-2064-8801~2')) . PHP_EOL;
