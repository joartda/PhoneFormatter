# PhoneFormatter

한국형 전화번호 포맷 변환기 입니다.

엑셀의 전화번호 서식을 PHP에서 인식하지 못하는 경우와 엑셀에 숫자 0으로 시작하는 셀의 경우 PHP에서는 0을 제외하고 인식하여 제작하게 되었습니다.


설치법
```
composer require joart/phoneformatter
```

사용법
```
$PhoneFormatter = new Joart\PhoneFormatter\PhoneFormatter();
var_dump($PhoneFormatter->change('15345678')) . PHP_EOL;
var_dump($PhoneFormatter->change('1012345678')) . PHP_EOL;
```
