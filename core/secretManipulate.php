<?php
namespace Core;
require_once 'config.php';

use Core\Config;

class SecretManipulate {
    private $_payload;

    public function __construct($payload) {
        $this->_payload = $payload;
    }

    public function writeToSecret(): void
    {
        if ($this->_payload != "") {
            $config = new Config();
            $secretFile = __DIR__ . "/" . $config->getSercretPath();
            $file = fopen($secretFile , "w");
            fwrite($file, $this->_payload);
            fclose($file);
        }
    }

    public function readSecret():string
    {
        $config = new Config();
        return file_get_contents(__DIR__ . "/". $config->getSercretPath());
    }
}
