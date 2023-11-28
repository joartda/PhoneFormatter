<?php

namespace Joart\PhoneFormatter;

use Joart\PhoneFormatter\Types\Biz;
use Joart\PhoneFormatter\Types\Disposable;
use Joart\PhoneFormatter\Types\Local;
use Joart\PhoneFormatter\Types\Phone;

class PhoneFormatter
{
    public function change($phoneNumber): mixed
    {
        $phoneNumberPure = preg_replace('/\D/', '', $phoneNumber);
        if($newNumber = (new Local)->change($phoneNumberPure)) {
            return $newNumber;
        } elseif($newNumber = (new Phone)->change($phoneNumberPure)) {
            return $newNumber;
        } elseif($newNumber = (new Biz)->change($phoneNumberPure)) {
            return $newNumber;
        } elseif($newNumber = (new Disposable)->change($phoneNumberPure)) {
            return $newNumber;
        }
        return $phoneNumber;
    }

}