<?php


namespace App\Config;


class Config
{
    public static string $templateFileExtension = ".twig";
    public static string $controllerNamespace = "App\\Controllers\\";
    public static string $templateDirectory = "App/Views/";
    public static string $translantionFile = "App/Config/lang/";
    public static string $language = 'cz';
    public static array $maxPositions = ["x" => 6, "y" => 6];


    public static array $database = [
        "host" => "194.182.83.19",
        "user" => "jakub",
        "password" => "Tatarak123..",
        "database" => "maturitni_projekt"
    ];
}
