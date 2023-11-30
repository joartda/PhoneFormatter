<?php

namespace Joart\PhoneFormatter\Types;

interface TypesInterface
{
  public function change(string $phoneNumber): mixed;
}
