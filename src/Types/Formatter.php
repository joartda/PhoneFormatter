<?php

namespace Joart\PhoneFormatter\Types;

abstract class Formatter
{
  
  protected function startsWith($haystack, $needle)
  {
      return substr($haystack, 0, strlen($needle)) === $needle;
  }
}
