<?php

namespace Joart\PhoneFormatter\Types;

class Local extends TypesAbstract implements TypesInterface
{
  protected array $preNumbers = array(
    '02'  => [9, 10],
    '031' => [10, 11],
    '032' => [10, 11],
    '033' => [10, 11],
    '041' => [10, 11],
    '042' => [10, 11],
    '043' => [10, 11],
    '044' => [10, 11],
    '051' => [10, 11],
    '052' => [10, 11],
    '053' => [10, 11],
    '054' => [10, 11],
    '055' => [10, 11],
    '061' => [10, 11],
    '062' => [10, 11],
    '063' => [10, 11],
    '064' => [10, 11]
  );

  public function change(string $phoneNumber): mixed
  {
    $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers);
    if ($this->isValid($phoneNumber, $phoneNumberSpecs)) {
      if ($phoneNumber[0] !== '0') {
        $phoneNumber = '0' . $phoneNumber;
      }
      $phoneLen = strlen($phoneNumber);
      if (!str_starts_with($phoneNumber, '02')) {
        $phoneLen -= 1;
      }
      if ($phoneLen === 9) {
        $offsets = array(
          array(-4, 4),
          array(-3, 3),
        );
      } else if ($phoneLen === 10) {
        $offsets = array(
          array(-4, 4),
          array(-4, 4),
        );
      }
      return $this->format($phoneNumber, $offsets);
    }
    return false;
  }
}
