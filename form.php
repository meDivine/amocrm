<?php
require_once 'core/leads.php';

use core\Leads;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leads = new Leads($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["price"]);
    $leads->send();
}
