<?php

namespace Joart\PhoneFormatter\Types;

class Phone extends TypesAbstract implements TypesInterface
{
  protected array $preNumbers = array(
    '010' => 11,
    '011' => 11,
    '012' => 11,
    '013' => 11,
    '015' => 11,
    '016' => 11,
    '017' => 11,
    '018' => 11,
    '019' => 11
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
              array(-4, 4),
          );
          return $this->format($phoneNumber, $offsets);
      }
      return false;
  }
}
