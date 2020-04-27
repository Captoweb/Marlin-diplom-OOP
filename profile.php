<?php
require_once 'init.php';

$id = $_GET['id'];

$users = Database::getInstance()->get('users', ['id', '=', $id]); // выводим всех пользователей id

$user = new User;

$validate = new Validate();

$validate->check($_POST, [
    'username' => [
        'required' => true,
        'min' => 2
    ],
    'status' =>  [
        'required'  =>  true,
        'min'    =>  '6'
    ]
]); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile Update</title>
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

            <? if ($user->hasPermissions('admin')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="adminka/index.php">Управление пользователями</a>
                </li>
            <? endif; ?>
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
            <h1>Профиль пользователя -  <?= $user->data()->username ;?></h1>

            <? if(Input::exists()) {
                if(Token::check(Input::get('token'))) {
                    if($validate->passed()) {
                        $user->update(['username' => Input::get('username')]);
                        $user->update(['status' => Input::get('status')]);
                        //Redirect::to('/profile.php?id=<?=$users->first()->id;');
                        Session::flash('success', '<div class="alert alert-success" role="alert">Профиль обновлен</div>');
                    } else {
                        foreach($validate->errors() as $error) {
                            echo $error . '<br>';
                        }
                    }
                }
            }
            ?>

            <!-- <div class="alert alert-success">Профиль обновлен</div> -->

            <!-- <div class="alert alert-danger">
                <ul>
                    <li>Ошибка валидации</li>
                </ul>
            </div>-->
            <?php echo Session::flash('success'); ?>
            <ul>
                <li><a href="changepassword.php">Изменить пароль</a></li>
            </ul>

      <? $users = Database::getInstance()->get('users', ['id', '=', $id]);
            $user = new User; ?>

            <form action="" class="form" method="post">
                <div class="form-group">
                    <label for="username">Имя</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?= $users->first()->username;?>">

                </div>
                <div class="form-group">
                    <label for="status">Статус</label>
                    <input type="text" id="status" name="status" class="form-control" value="<?= $users->first()->status;?>">

                </div>

                <div class="form-group">
                    <button class="btn btn-warning">Обновить</button>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate();?>">
            </form>

        </div>
    </div>
</div>
</body>
</html>

