<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use core\Config;
use core\SecretManipulate;
use core\TokenManipulate;

require_once 'config.php';
require_once 'secretManipulate.php';
require_once 'tokenManipulate.php';

class RefreshAuth {
    private function makePayload(): array
    {
        $config = new Config();
        $secret = new SecretManipulate("");
        return [
            "client_id" => $config->getClientId(),
            "client_secret" => $config->getSecretKey(),
            "grant_type" => "authorization_code",
            "code" => $secret->readSecret(),
            "redirect_uri" => $config->getRedirectUrl()
        ];
    }
    private function sendRequest(): string {
        $client = new Client();
        $config = new Config();
        $body = "";
        try {
            $response = $client->post($config->getDomain(), [
                'form_params' => $this->makePayload(),
            ]);
            if ($response->getStatusCode() == 200)
                $body = $response->getBody();
            else
                $body = "error";
        }
        catch (GuzzleHttp\Exception\RequestException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $body;
    }
    public function writeTokenFile() {
        $payload = $this->sendRequest();
        if ($payload != "error")
        {
            $tokenManipulate = new TokenManipulate($payload);
            $tokenManipulate->writeToTokenFile();
        }
    }
}
