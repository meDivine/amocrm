<?php
namespace Core;

require_once 'leads.php';
use Core\Leads;

class FormSender {
    private $_name;
    private $_email;
    private $_phone;
    private $_price;
    private array $_errors;

    public function __construct($name, $email, $phone, $price) {
        $this->_name = $name;
        $this->_email = $email;
        $this->_phone = $phone;
        $this->_price = $price;
    }

    private function validateName() {
        if (empty($this->_name)) {
            $this->_errors['name'] = "Имя обязательно для заполнения";
        }
    }

    private function validateEmail() {
        if (empty($this->_email)) {
            $this->_errors['email'] = "Email обязателен для заполнения";
        } elseif (!filter_var($this->_email, FILTER_VALIDATE_EMAIL)) {
            $this->_errors['email'] = "Некорректный формат email";
        }
    }

    private function validatePhone() {
        if (empty($this->_phone)) {
            $this->_errors['phone'] = "Телефон обязателен для заполнения";
        } elseif (!preg_match("/^\+?\d{1,3}\(?\d{3}\)?\d{3}-?\d{2}-?\d{2}$/", $this->_phone)) {
            $this->_errors['phone'] = "Некорректный формат телефона";
        }
    }

    private function validatePrice() {
        if (empty($this->_price)) {
            $this->_errors['price'] = "Цена обязательна для заполнения";
        } elseif (!is_numeric($this->_price)) {
            $this->_errors['price'] = "Цена должна быть числом";
        }
    }

    public function sendForm() : string
    {
        $this->validateName();
        $this->validateEmail();
        $this->validatePhone();
        $this->validatePrice();

        if (empty($this->_errors)) {
            $leads = new Leads($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["price"]);
            $leads->send();
            return json_encode(["success" => true, "message" => "Данные успешно отправлены!"]);
        }
        else {
            return json_encode(["success" => false, "errors" => $this->_errors]);
        }
    }
}
