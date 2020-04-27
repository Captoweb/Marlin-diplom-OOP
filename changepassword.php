<?php
require_once 'init.php';

$user = new User;

$validate = new Validate();

$validate->check($_POST, [
    'current_password' => ['required' => true, 'min' => 5],
    'new_password' => ['required' => true, 'min' => 5],
    'new_password_again' => ['required' => true, 'min' => 5, 'matches' => 'new_password'],
]); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            <li class="nav-item">
                <a class="nav-link" href="adminka/index.php">Управление пользователями</a>
            </li>
        </ul>

        <ul class="navbar-nav">

            <? if ($user->isLoggedIn()): ?>
                <li class="nav-item"><a class="nav-link" href='#'>Hi, <?= $user->data()->username; ?></a></li>
                <li class="nav-item"><a class="nav-link" href='logout.php'> Logout</a></li>
            <? else: ?>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">Войти</a>
                </li>
                <li class="nav-item">
                    <a href="register.php" class="nav-link">Регистрация</a>
                </li>
            <? endif; ?>

        </ul>

    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Изменить пароль</h1>
            <? if(Input::exists()) {
                if(Token::check(Input::get('token'))) {
                    if($validate->passed()) {

                        if(password_verify(Input::get('current_password'), $user->data()->password)) {
                            $user->update(['password'   =>  password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);
                            Session::flash('success', '<div class="alert alert-success" role="alert">Пароль обновлен</div>');
                            //Redirect::to('index.php');
                        } else {
                            $passError = '<div class="alert alert-danger" role="alert">Пароль не подходит</div>';
                        }

                    } else {
                        foreach($validate->errors() as $error) {
                            echo $error . '<br>';
                        }
                    }

                }
            }
            ?>
            <!-- <div class="alert alert-success">Пароль обновлен</div> -->

            <!-- <div class="alert alert-danger">
                <ul>
                    <li>Ошибка валидации</li>
                </ul>
            </div> -->
            <?php echo Session::flash('success'); ?>
            <?php echo @$passError; ?>
            <ul>
                <li><a href="profile.php">Изменить профиль</a></li>
            </ul>


            <form action="" class="form"  method="post">
                <div class="form-group">
                    <label for="current_password">Текущий пароль</label>
                    <input type="password" id="current_password" name="current_password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="current_password">Новый пароль</label>
                    <input type="password" id="current_password" name="new_password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="current_password">Повторите новый пароль</label>
                    <input type="password" id="current_password" name="new_password_again"  class="form-control">
                </div>

                <div class="form-group">
                    <button class="btn btn-warning">Изменить</button>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate();?>">
            </form>

        </div>
    </div>
</div>
</body>
</html>

