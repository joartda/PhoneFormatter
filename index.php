<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

$PhoneFormatter = new Joart\PhoneFormatter\PhoneFormatter();
var_dump($PhoneFormatter->change('15345678'));
var_dump($PhoneFormatter->change('1012345678'));
var_dump($PhoneFormatter->change('7012345678'));
var_dump($PhoneFormatter->change('212341234'));
var_dump($PhoneFormatter->change('03111112222'));
var_dump($PhoneFormatter->change('0311112222'));
