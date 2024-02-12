<?php
require_once 'core/formSender.php';

use Core\FormSender;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form = new FormSender($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["price"]);
    $form->sendForm();
}
