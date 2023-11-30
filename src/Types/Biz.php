<?php

namespace Joart\PhoneFormatter\Types;

class Biz extends TypesAbstract implements TypesInterface
{
  protected array $preNumbers = array(
    '13' => 8,
    '15' => 8,
    '16' => 8,
    '18' => 8
  );

  public function change(string $phoneNumber): mixed
  {
      $phoneNumberSpecs = $this->preNumbers;
      if($this->isValid($phoneNumber, $phoneNumberSpecs)) {
          $offsets = array(
              array(-4, 4),
          );
          return $this->format($phoneNumber, $offsets);
      }
      return false;
  }
}
