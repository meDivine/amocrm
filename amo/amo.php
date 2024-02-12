<?php
require_once '../core/secretManipulate.php';
require_once '../core/refreshAuth.php';
use RefreshAuth;
use Core\SecretManipulate;

//псевдо csrf проверка
if ($_GET['state'] == "asd") {
    $secret = new SecretManipulate($_GET['code']);
    $auth = new RefreshAuth();
    $secret->writeToSecret();
    $auth->writeTokenFile();
    header("Location: ../index.php");
}
