<?php
require_once '../init.php';

$id = $_GET['id'];


$users = Database::getInstance()->get('users', ['id', '=', $id]); // выводим всех пользователей id
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">User Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Главная</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link">Войти</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Регистрация</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Данные пользователя</h1>
            <table class="table table-responsive">
                <thead>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата регистрации</th>
                <th>Статус</th>
                <th>Email</th>
                <th>Group_id</th>
                </thead>

                <tbody>
                <tr>
                    <td><? echo $users->first()->id;?></td>
                    <td><? echo $users->first()->username;?></td>
                    <td><? echo $users->first()->time;?></td>
                    <td><? echo $users->first()->status;?></td>
                    <td><? echo $users->first()->email;?></td>
                    <td><? echo $users->first()->group_id;?></td>
                </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>
</body>
</html>
