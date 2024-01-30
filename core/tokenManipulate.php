<?php

namespace core;

class TokenManipulate {
    private $_payload;

    public function __construct($payload) {
        $this->_payload = $payload;
    }

    public function writeToTokenFile(): void
    {
        if ($this->_payload != "") {
            $config = new Config();
            $secretFile = __DIR__ . "/" . $config->getTokenPath();
            $file = fopen($secretFile , "w");
            fwrite($file, $this->_payload);
            fclose($file);
        }
    }

    private function getTokenPath():string  {
        $config = new Config();
        return __DIR__ . "/". $config->getTokenPath();
    }

    private function readTokenPayload(): string {
        return file_get_contents($this->getTokenPath());
    }

    private function decodeTokenFile(): array {
        return json_decode($this->readTokenPayload(), true);
    }

    public function readSecret(): array
    {
        return $this->decodeTokenFile();
    }
}
