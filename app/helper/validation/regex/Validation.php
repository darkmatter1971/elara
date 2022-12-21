<?php
class Validator {
    const EMAIL_PATTERN = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    const USERNAME_PATTERN = '/^[a-z\d_]{5,20}$/i';
    const PHONE_PATTERN = '/\(?\d{3}\)?[-\s.]?\d{3}[-\s.]\d{4}/x';
    const IP_PATTERN = '/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';
    const ZIPCODE_PATTERN = '/^([0-9]{5})(-[0-9]{4})?$/i';
    const SSN_PATTERN = '/^[\d]{3}-[\d]{2}-[\d]{4}$/';
    const CC_PATTERN = '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/';
    const URL_PATTERN = '/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i';

    // Validate Email
    public static function validateEmail(string $email): bool {
        return preg_match(self::EMAIL_PATTERN, $email);
    }

    // Validate Username
    public static function validateUsername(string $username): bool {
        return preg_match(self::USERNAME_PATTERN, $username);
    }

    // Validate US Phone # 
    public static function validatePhone(string $phone): bool {
        return preg_match(self::PHONE_PATTERN, $phone);
    }

    // Validate IP addresses
    public static function validateIP(string $IP): bool {
        return preg_match(self::IP_PATTERN, $IP);
    }

    // Validate Us Postal Codes
    public static function validateZipCode(string $zipcode): bool {
        return preg_match(self::ZIPCODE_PATTERN, $zipcode);
    }
}


// https://gist.github.com/cam-gists/3074695
// https://gist.github.com/InTheScript/8619042
// class Regex
// {
//     // pattern for matching an email address
//     const EMAIL_PATTERN = '/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';

//     // pattern for matching a US phone number
//     const US_PHONE_PATTERN = '/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/';

//     // pattern for matching a US zip code
//     const US_ZIP_PATTERN = '/^\d{5}(?:[-\s]\d{4})?$/';

//     // pattern for matching a credit card number
//     const CREDIT_CARD_PATTERN = '/^(?:(4[0-9]{12}(?:[0-9]{3})?)|(5[1-5][0-9]{14})|(6(?:011|5[0-9]{2})[0-9]{12})|(3[47][0-9]{13})|(3(?:0[0-5]|[68][0-9])[0-9]{11})|((?:2131|1800|35[0-9]{3})[0-9]{11}))$/';
// }