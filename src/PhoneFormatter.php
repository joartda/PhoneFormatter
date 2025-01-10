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
    ) {}

    public function change($phoneNumber): mixed
    {
        $tail = $this->isMultiple($phoneNumber);
        $phoneNumberPure = preg_replace('/\D/', '', $phoneNumber);
        if ($newNumber = $this->Local->change($phoneNumberPure)) {
        } elseif ($newNumber = $this->Phone->change($phoneNumberPure)) {
        } elseif ($newNumber = $this->Biz->change($phoneNumberPure)) {
        } elseif ($newNumber = $this->Disposable->change($phoneNumberPure)) {
        } elseif ($newNumber = $this->Internet->change($phoneNumberPure)) {
        }
        if (empty($newNumber)) {
            return $phoneNumber;
        }
        if ($tail !== false) {
            return $newNumber . $tail;
        }
        return $newNumber;
    }

    private function isMultiple(string $phoneNumber): string|bool
    {
        $div = null;
        if (str_contains($phoneNumber, '~')) {
            $div = '~';
        } else if (str_contains($phoneNumber, '/')) {
            $div = '/';
        } else if (str_contains($phoneNumber, '#')) {
            $div = '#';
        } else if (str_contains($phoneNumber, ',')) {
            $div = ',';
        }
        if ($div !== null) {
            $tmp = explode($div, $phoneNumber);
            if (isset($tmp[1])) {
                return $div . $tmp[1];
            };
        }
        return false;
    }
}
