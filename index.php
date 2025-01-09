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

// 휴대폰 번호 예제
var_dump($PhoneFormatter->change('01012345678')); // 010-1234-5678
var_dump($PhoneFormatter->change('01612345678')); // 016-1234-5678
var_dump($PhoneFormatter->change('0191234567')); // 019-123-4567

// 지역번호 예제
var_dump($PhoneFormatter->change('0212345678')); // 02-1234-5678
var_dump($PhoneFormatter->change('0312345678')); // 031-234-5678
var_dump($PhoneFormatter->change('0512345678')); // 051-234-5678

// 특수번호 예제
var_dump($PhoneFormatter->change('15881234')); // 1588-1234
var_dump($PhoneFormatter->change('15441234')); // 1544-1234
var_dump($PhoneFormatter->change('15771234')); // 1577-1234

// 내선번호 포함 예제
var_dump($PhoneFormatter->change('02-1234-5678#123')); // 02-1234-5678#123
var_dump($PhoneFormatter->change('031-123-4567,89')); // 031-123-4567,89

// 기존 포맷된 번호 예제
var_dump($PhoneFormatter->change('02)123-4567')); // 02-123-4567
var_dump($PhoneFormatter->change('(031)123-4567')); // 031-123-4567
var_dump($PhoneFormatter->change('010.1234.5678')); // 010-1234-5678
