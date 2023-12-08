<?php

namespace Joart\PhoneFormatter;

class PhoneFormatter
{
    public $phoneNumber;

    private $preNumbers = array(
        'local' => array('02' => 9, '031' => 10, '032' => 10, '033' => 10, '041' => 10, '042' => 10, '043' => 10, '044' => 10, '051' => 10, '052' => 10, '053' => 10, '054' => 10, '055' => 10, '061' => 10, '062' => 10, '063' => 10, '064' => 10),
        'phone' => array('010' => 11, '011' => 11, '012' => 11, '013' => 11, '015' => 11, '016' => 11, '017' => 11, '018' => 11, '019' => 11),
        'biz' => array('13' => 8, '15' => 8, '16' => 8, '18' => 8),
        'disposable' => array('050' => 12),
        'internet' => array('070' => 11),
    );

    public function change($phoneNumber)
    {
        $phoneNumberPure = preg_replace('/\D/', '', $phoneNumber);
        if($val = $this->isLocal($phoneNumberPure)) {
            return $val;
        } elseif($val = $this->isPhone($phoneNumberPure)) {
            return $val;
        } elseif($val = $this->isBiz($phoneNumberPure)) {
            return $val;
        } elseif($val = $this->isDisposable($phoneNumberPure)) {
            return $val;
        } elseif($val = $this->isInternet($phoneNumberPure)) {
            return $val;
        }
        return $phoneNumber;
    }

    public function isLocal($phoneNumber)
    {
        $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers['local']);
        if($this->isValid($phoneNumber, $phoneNumberSpecs)) {
            if($phoneNumber[0] !== '0') {
                $phoneNumber = '0' . $phoneNumber;
            }
            $offsets = array(
                array(-4, 4),
                array(-3, 3),
            );
            return $this->format($phoneNumber, $offsets);
        }
        return false;
    }

    public function isPhone($phoneNumber)
    {
        $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers['phone']);
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

    public function isBiz($phoneNumber)
    {
        $phoneNumberSpecs = $this->preNumbers['biz'];
        if($this->isValid($phoneNumber, $phoneNumberSpecs)) {
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

    public function isInternet($phoneNumber)
    {
        $phoneNumberSpecs = $this->addNoneZeroList($this->preNumbers['internet']);
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

    public function isValid($phoneNumber, $phoneNumberSpecs)
    {
        foreach($phoneNumberSpecs as $specNunber => $specLen) {
            $specNunber = (string) $specNunber;
            if($this->startsWith($phoneNumber, $specNunber) && strlen($phoneNumber) === $specLen) {
                return true;
            }
        }
        return false;
    }

    public function format($phoneNumber, $offsets)
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

    public function addNoneZeroList($phoneNumberSpecs)
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

    public function startsWith($haystack, $needle)
    {
        return substr($haystack, 0, strlen($needle)) === $needle;
    }
}