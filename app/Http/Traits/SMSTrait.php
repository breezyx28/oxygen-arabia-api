<?php

namespace App\Http\Traits;

use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

const USER = 'test';
const PASSWORD = 't@123';
const DOMIAN = 'http://212.0.148.251/obs/webacc.aspx';

trait SMSTrait
{
    public $phone_number = null;

    public function send_message(string $message, array|string $numbers)
    {
        $response = Http::get(DOMIAN, [
            'user' => USER,
            'pwd' => PASSWORD,
            'smstext' => $message ?? '',
            'sender' => 'Oxygen Tech',
            'Nums' => (string) $this->fixed_phone_numbers($numbers),
        ]);
        // return throw new Error($this->fixed_phone_numbers($numbers));
        $sms_reponse = null;
        $response_body = $response->body();

        Str::startsWith($response_body, 'Invalid') ? $sms_reponse = 'Invalid' : null;
        Str::startsWith($response_body, 'rejected') ? $sms_reponse = 'rejected' : null;
        Str::startsWith($response_body, 'OK') ? $sms_reponse = 'Ok' : null;

        $result = ['Invalid' => 'Invalid', 'Ok' => 'true value', 'rejected' => 'You don\'t have enough points'][$sms_reponse];

        Log::channel('smslog')->info($result);

        if ($result == 'Invalid') {
            return false;
        }

        if ($result == 'rejected') {
            return false;
        }

        return true;
    }

    private function fixed_phone_numbers(array|string $numbers)
    {
        $nums = '';

        if (is_array($numbers)) {
            $this->numbers_array($numbers);
            $numbers = $this->convert_array_numbers_to_249($numbers);
            $nums = implode(";", $numbers);
        }

        if (is_string($numbers)) {
            $this->validate_single_phone_number($numbers);
            $nums = $numbers;
            if ($this->phone_number != null) {
                $nums = (string) $this->phone_number;
            }
        }

        return $nums;
    }

    private function convert_array_numbers_to_249(array $numbers)
    {
        $new_numbers = [];
        foreach ($numbers as $value) {
            if (Str::startsWith($value, '0') == true) {
                $new_numbers[] = Str::replaceFirst('0', '249', $value);
            } else {
                $new_numbers[] = $value;
            }
        }

        return $new_numbers;
    }

    private function numbers_array(array $array_of_numbers)
    {
        foreach ($array_of_numbers as $key => $value) {
            $this->validate_phone_number($value);
        }

        return true;
    }

    private function validate_phone_number(array|string $validate)
    {
        // is numeric
        if (!is_numeric($validate)) {
            return $this->error_msg('This Phone number isn\'t numeric (' . $validate . ')');
        }

        // should be 12 or 10 digit length
        if ((strlen($validate) != 12) == true && (strlen($validate) != 10) == true) {
            return $this->error_msg('This Phone number length isn\'t 12 digits or 10 (' . $validate . ')');
        }

        // // should start with 249
        if (Str::startsWith($validate, '249') == true && strlen($validate) == 12) {
            return $this->error_msg('This Phone number should start with 249 (' . $validate . ')');
        }

        return true;
    }

    private function validate_single_phone_number(array|string $validate)
    {
        // is numeric
        if (!is_numeric($validate)) {
            return $this->error_msg('This Phone number isn\'t numeric (' . $validate . ')');
        }

        // should be 10 digit length
        if (strlen($validate) != 10) {
            return $this->error_msg('This Phone number length isn\'t 10 (' . $validate . ')');
        }

        // // if start with 0 it should be converted to global number start with 249
        if (Str::startsWith($validate, '0') == true && strlen($validate) == 10) {
            $this->phone_number = $this->convert_phone_number($validate);
        }


        return true;
    }

    public function convert_phone_number(string $phone_number): int
    {
        // length should be 10 digits
        if (strlen($phone_number) != 10) {
            return $this->error_msg('This Phone number length isn\'t 10 digits long (' . $phone_number . ')');
        }
        return Str::replaceFirst('0', '249', $phone_number);
    }

    private function error_msg(string $message)
    {
        return throw new Error($message);
    }
}
