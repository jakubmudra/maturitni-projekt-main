<?php


class Formater
{
    public static $currency = "Kč";
    public static $currencyPosition = "right";

    public static function formatPrice($number, $decimals = 2, $decimal = ".", $thousands = ".")
    {
        $price = number_format($number, $decimals, $decimal, $thousands);
        $prefix = $suffix = "";
        if (self::$currencyPosition == "left")
            $prefix = self::$currency;
        else
            $suffix = self::$currency;

        return ($prefix . $price . $suffix);
    }

    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
