<?php
namespace Core;

class Config {
    private static $clientId = "";
    private static $secretKey = "";
    private static $redirectUrl = "https://divinebots.ovh/amo/amo.php";
    private static $domain = "https://snowstormz.amocrm.ru/oauth2/access_token";
    private static $secretFilePath = "secret.txt";
    private static $tokenPath = "token.json";

    public function getClientId(): string
    {
        return self::$clientId;
    }

    public function getSecretKey(): string
    {
        return self::$secretKey;
    }

    public function getRedirectUrl(): string
    {
        return self::$redirectUrl;
    }

    public function getDomain() : string
    {
        return self::$domain;
    }

    public function getSercretPath(): string
    {
        return self::$secretFilePath;
    }

    public function getTokenPath(): string
    {
        return self::$tokenPath;
    }
}
