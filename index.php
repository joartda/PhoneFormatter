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
var_dump($PhoneFormatter->change('236644466'));
var_dump($PhoneFormatter->change('7075436504'));
var_dump($PhoneFormatter->change('222578222'));
var_dump($PhoneFormatter->change('(02) 503-0495'));
var_dump($PhoneFormatter->change('25113004'));
var_dump($PhoneFormatter->change('(022) 107-0093'));
var_dump($PhoneFormatter->change('438720430'));
var_dump($PhoneFormatter->change('02-715-7244 / ~5'));
var_dump($PhoneFormatter->change('02-715-7244 /5'));
var_dump($PhoneFormatter->change('02-715-7244 ~ 5'));
