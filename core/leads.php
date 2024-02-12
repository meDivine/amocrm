<?php
namespace Core;
require 'vendor/autoload.php';
require_once 'config.php';
require_once 'tokenManipulate.php';

use core\TokenManipulate;
use GuzzleHttp\Client;

class Leads {
    private $_name;
    private $_email;
    private $_phoneNumber;
    private $_price;

    public function __construct($name, $email, $phoneNumber, $price)
    {
        $this->_name = $name;
        $this->_email = $email;
        $this->_phoneNumber = $phoneNumber;
        $this->_price = $price;
    }

    private function getToken() {
        $token = new TokenManipulate("");
        return $token->readSecret();
    }

    private function preparedData(): array {
        return [
            [
                "name" => "Сделка",
                "price" => $this->_price,
                "_embedded" => [
                    "contacts" => [
                        [
                            "first_name" => $this->_name,
                            "custom_fields_values" => [
                                [
                                    "field_code" => "EMAIL",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => $this->_email
                                        ]
                                    ]
                                ],
                                [
                                    "field_code" => "PHONE",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => $this->_phoneNumber
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function send(): string {
        $client = new Client();
        $accessToken = $this->getToken()['access_token'];
        $subdomain = 'snowstormz';

        $client = new Client();

        $url = "https://{$subdomain}.amocrm.ru/api/v4/leads/complex";

        $response = $client->post($url, [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Content-Type' => 'application/json',
            ],
                'json' => $this->preparedData(),
            ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        if ($statusCode === 200) {
            return "Сделка успешно создана.";
        } else {
            return "{$body}";
        }
    }
}
