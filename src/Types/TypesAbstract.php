<?php

namespace Joart\PhoneFormatter\Types;

class TypesAbstract
{
  protected function addNoneZeroList(array $phoneNumberSpecs): array
  {
      array_walk($phoneNumberSpecs, function ($value, $key) use (&$phoneNumberSpecs) {
          $key = (string) $key;
          if($key[0] === '0') {
              $key = substr($key, 1, strlen($key));
              $value -= 1;
          }
          if(!isset($phoneNumberSpecs[$key])) {
              $phoneNumberSpecs[$key] = $value;
          }
      });
      return $phoneNumberSpecs;
  }

  protected function format(string $phoneNumber, array $offsets):string
  {
      $phoneNumberArr = str_split($phoneNumber);
      $last = implode('', array_splice($phoneNumberArr, $offsets[0][0], $offsets[0][1]));
      $middle = '';
      if(isset($offsets[1])) {
          $middle = implode('', array_splice($phoneNumberArr, $offsets[1][0], $offsets[1][1])) . '-';
      }
      $first = implode('', $phoneNumberArr);
      return $first . "-" . $middle  . $last;
  }

  protected function isValid(string $phoneNumber, array $phoneNumberSpecs): bool
  {
      foreach($phoneNumberSpecs as $specNumber => $specLen) {
          $specNumber = (string) $specNumber;
          if($this->startsWith($phoneNumber, $specNumber) && strlen($phoneNumber) === $specLen) {
              return true;
          }
      }
      return false;
  }

  protected function startsWith(string $haystack, string $needle): bool
  {
      return substr($haystack, 0, strlen($needle)) === $needle;
  }
}
