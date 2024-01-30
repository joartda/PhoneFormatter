<?php

namespace Joart\PhoneFormatter;

use Joart\PhoneFormatter\Types\{
    TypesInterface,
    Disposable,
    Local,
    Phone,
    Biz,
    Internet,
};

class PhoneFormatter
{
    public function __construct(
        private TypesInterface $Local = new Local,
        private TypesInterface $Phone = new Phone,
        private TypesInterface $Biz = new Biz,
        private TypesInterface $Disposable = new Disposable,
        private TypesInterface $Internet = new Internet,
    ) {
    }

    public function change($phoneNumber): mixed
    {
        if ($phoneNumberPure = $this->isMultiple($phoneNumber)) {
            return $phoneNumberPure;
        }
        $phoneNumberPure = preg_replace('/\D/', '', $phoneNumber);
        if ($newNumber = $this->Local->change($phoneNumberPure)) {
            return $newNumber;
        } elseif ($newNumber = $this->Phone->change($phoneNumberPure)) {
            return $newNumber;
        } elseif ($newNumber = $this->Biz->change($phoneNumberPure)) {
            return $newNumber;
        } elseif ($newNumber = $this->Disposable->change($phoneNumberPure)) {
            return $newNumber;
        } elseif ($newNumber = $this->Internet->change($phoneNumberPure)) {
            return $newNumber;
        }
        return $phoneNumber;
    }

    private function isMultiple(string $phoneNumber): string|bool
    {
        if (str_contains($phoneNumber, '~') || str_contains($phoneNumber, '/')) {
            return str_replace(' ', '', $phoneNumber);
        }
        return false;
    }
}
