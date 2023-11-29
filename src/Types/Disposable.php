<?php

namespace Joart\PhoneFormatter\Types;

class Disposable extends TypesAbstract
{
  protected array $preNumbers = array(
    '050' => 12
  );
  
  public function change(string $phoneNumber):mixed
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
