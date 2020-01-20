<?php

class Validator
{
    public static function email($emailToValidate)
    {
        if (filter_var($emailToValidate, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function password($passwordToValidate, $minChar = 8, $numbers = true, $specials = true, $oneCapital = true, $oneLower = true)
    {
        $validated = true;

        $minLength = (strlen($passwordToValidate) >= 8) ?: 0;
        $uppercase = preg_match('@[A-Z]@', $passwordToValidate);
        $lowercase = preg_match('@[a-z]@', $passwordToValidate);
        $number    = preg_match('@[0-9]@', $passwordToValidate);
        $specialChars = preg_match('@[^\w]@', $passwordToValidate);

        if($minLength == 0)
            $validated = false;
        if($numbers && $number == 0)
            $validated = false;
        if($specials && $specialChars == 0)
            $validated = false;
        if($oneCapital && $uppercase == 0)
            $validated = false;
        if($oneLower && $lowercase == 0)
            $validated = false;

        return $validated;
    }

    public static function isLogged()
    {
        return true;
    }
}
