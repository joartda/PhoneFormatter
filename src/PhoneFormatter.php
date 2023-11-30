<?php

namespace Joart\PhoneFormatter;

use Joart\PhoneFormatter\Types\{
    TypesInterface,
    Disposable,
    Local,
    Phone,
    Biz,
};

class PhoneFormatter
{
    public function __construct(
        private TypesInterface $Local = new Local,
        private TypesInterface $Phone = new Phone,
        private TypesInterface $Biz = new Biz,
        private TypesInterface $Disposable = new Disposable,
    )
    {
    }

    public function change($phoneNumber): mixed
    {
        $phoneNumberPure = preg_replace('/\D/', '', $phoneNumber);
        if($newNumber = $this->Local->change($phoneNumberPure)) {
            return $newNumber;
        } elseif($newNumber = $this->Phone->change($phoneNumberPure)) {
            return $newNumber;
        } elseif($newNumber = $this->Biz->change($phoneNumberPure)) {
            return $newNumber;
        } elseif($newNumber = $this->Disposable->change($phoneNumberPure)) {
            return $newNumber;
        }
        return $phoneNumber;
    }

}