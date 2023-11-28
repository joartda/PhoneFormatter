<?php

namespace Joart\PhoneFormatter\Types;

class Local extends TypesAbstract
{
  protected array $preNumbers = array(
    '02'  => 9,
    '031' => 10,
    '032' => 10,
    '033' => 10,
    '041' => 10,
    '042' => 10,
    '043' => 10,
    '044' => 10,
    '051' => 10,
    '052' => 10,
    '053' => 10,
    '054' => 10,
    '055' => 10,
    '061' => 10,
    '062' => 10,
    '063' => 10,
    '064' => 10
  );

  public function change(string $phoneNumber): mixed
  {
      $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers);
      if($this->isValid($phoneNumber, $phoneNumberSpecs)) {
          if($phoneNumber[0] !== '0') {
              $phoneNumber = '0' . $phoneNumber;
          }
          $offsets = array(
              array(-4, 4),
              array(-3, 3),
          );
          return $this->format($phoneNumber, $offsets);
      }
      return false;
  }
}
