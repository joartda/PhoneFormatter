<?php

namespace Joart\PhoneFormatter;

class PhoneFormatter
{
    public $phoneNumber;

    private $preNumbers = array(
        'local' => array(
            '02'  => array(9, 10),
            '031' => array(10, 11),
            '032' => array(10, 11),
            '033' => array(10, 11),
            '041' => array(10, 11),
            '042' => array(10, 11),
            '043' => array(10, 11),
            '044' => array(10, 11),
            '051' => array(10, 11),
            '052' => array(10, 11),
            '053' => array(10, 11),
            '054' => array(10, 11),
            '055' => array(10, 11),
            '061' => array(10, 11),
            '062' => array(10, 11),
            '063' => array(10, 11),
            '064' => array(10, 11)
        ),
        'phone' => array(
            '010' => array(11),
            '011' => array(11),
            '012' => array(11),
            '013' => array(11),
            '015' => array(11),
            '016' => array(11),
            '017' => array(11),
            '018' => array(11),
            '019' => array(11)
        ),
        'biz' => array(
            '13' => array(8),
            '15' => array(8),
            '16' => array(8),
            '18' => array(8)
        ),
        'disposable' => array(
            '050' => array(12)
        ),
        'internet' => array(
            '070' => array(11)
        ),
    );

    public function change($phoneNumber)
    {
        $phoneNumberPure = preg_replace('/\D/', '', $phoneNumber);
        if ($val = $this->isLocal($phoneNumberPure)) {
            return $val;
        } elseif ($val = $this->isPhone($phoneNumberPure)) {
            return $val;
        } elseif ($val = $this->isBiz($phoneNumberPure)) {
            return $val;
        } elseif ($val = $this->isDisposable($phoneNumberPure)) {
            return $val;
        } elseif ($val = $this->isInternet($phoneNumberPure)) {
            return $val;
        }
        return $phoneNumber;
    }

    public function isLocal($phoneNumber)
    {
        $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers['local']);
        if ($this->isValid($phoneNumber, $phoneNumberSpecs)) {
            if ($phoneNumber[0] !== '0') {
                $phoneNumber = '0' . $phoneNumber;
            }
            $phoneLen = strlen($phoneNumber);
            if (!$this->startsWith($phoneNumber, '02')) {
                $phoneLen -= 1;
            }
            if ($phoneLen === 9) {
                $offsets = array(
                    array(-4, 4),
                    array(-3, 3),
                );
            } else if ($phoneLen === 10) {
                $offsets = array(
                    array(-4, 4),
                    array(-4, 4),
                );
            }
            return $this->format($phoneNumber, $offsets);
        }
        return false;
    }

    public function isPhone($phoneNumber)
    {
        $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers['phone']);
        if ($this->isValid($phoneNumber, $phoneNumberSpecs)) {
            if ($phoneNumber[0] !== '0') {
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

    public function isBiz($phoneNumber)
    {
        $phoneNumberSpecs = $this->preNumbers['biz'];
        if ($this->isValid($phoneNumber, $phoneNumberSpecs)) {
            $offsets = array(
                array(-4, 4),
            );
            return $this->format($phoneNumber, $offsets);
        }
        return false;
    }

    public function isDisposable($phoneNumber)
    {
        $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers['disposable']);
        if ($this->isValid($phoneNumber, $phoneNumberSpecs)) {
            if ($phoneNumber[0] !== '0') {
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

    public function isInternet($phoneNumber)
    {
        $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers['internet']);
        if ($this->isValid($phoneNumber, $phoneNumberSpecs)) {
            if ($phoneNumber[0] !== '0') {
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

    public function isValid($phoneNumber, $phoneNumberSpecs)
    {
        foreach ($phoneNumberSpecs as $specNumber => $specLenArr) {
            $specNumber = (string) $specNumber;
            foreach ($specLenArr as $specLen) {
                if ($this->startsWith($phoneNumber, $specNumber) && strlen($phoneNumber) === $specLen) {
                    return true;
                }
            }
        }
        return false;
    }

    public function format($phoneNumber, $offsets)
    {
        $phoneNumberArr = str_split($phoneNumber);
        $last = implode('', array_splice($phoneNumberArr, $offsets[0][0], $offsets[0][1]));
        $middle = '';
        if (isset($offsets[1])) {
            $middle = implode('', array_splice($phoneNumberArr, $offsets[1][0], $offsets[1][1])) . '-';
        }
        $first = implode('', $phoneNumberArr);
        return $first . "-" . $middle  . $last;
    }

    public function addNoneZeroList($phoneNumberSpecs)
    {
        array_walk($phoneNumberSpecs, function ($value, $key) use (&$phoneNumberSpecs) {
            $key = (string) $key;
            if ($key[0] === '0') {
                $key = substr($key, 1, strlen($key));
                foreach ($value as $k => $v) {
                    $value[$k] -= 1;
                }
            }
            if (!isset($phoneNumberSpecs[$key])) {
                $phoneNumberSpecs[$key] = $value;
            }
        });
        return $phoneNumberSpecs;
    }

    public function startsWith($haystack, $needle)
    {
        return substr($haystack, 0, strlen($needle)) === $needle;
    }
}
