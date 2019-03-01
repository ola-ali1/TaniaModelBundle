<?php 

namespace Ibtikar\TaniaModelBundle\Service;

/**
 * class to validate phone number
 */
class PhoneNumber
{

    public function validatePhoneNumber($phone, $country = "")
    {
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $validPhone = false;
        try {
            $validPhone = $phoneUtil->isValidNumber($phoneUtil->parse($phone, $country));
        } catch (\libphonenumber\NumberParseException $e) {
            $validPhone = false;
        }

        return $validPhone;
    }
}