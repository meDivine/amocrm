<?php
require_once 'core/config.php';
use core\Config;

$config = new Config();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roistat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Форма</h2>

            <form id="myForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Почта</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>

                <a type="button" class="btn btn-secondary ml-2" href=" https://www.amocrm.ru/oauth?client_id=<?= $config->getClientId() ?>&state=asd&mode=popup">Авторизация</a>
            </form>

            <div id="result" class="mt-3"></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $("#myForm").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "form.php",
                data: formData,
                success: function (data) {
                    $("#result").html(data);
                },
                error: function () {
                    alert("Произошла ошибка при отправке данных.");
                }
            });
        });
    });
</script>

</body>
</html>
