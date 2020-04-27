<?php
require_once 'init.php';

echo Session::flash('success');
$user = new User;

$users = Database::getInstance()->query("SELECT * FROM users"); // вывожу всех пользователей

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profile</title>
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
            <a class="nav-link" href="#">Главная</a>
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
      <div class="col-md-12">
        <div class="jumbotron">
          <h1 class="display-4">Привет, мир!</h1>
          <p class="lead">Это дипломный проект по разработке на PHP. На этой странице список наших пользователей.</p>
          <hr class="my-4">
          <p>Чтобы стать частью нашего проекта вы можете пройти регистрацию.</p>


             <? if ($user->isLoggedIn()): ?>
                <a href="profile.php?id=<?=$users->first()->id;?>"> Hello, mr. <?= $user->data()->username ;?></a>

                 <? if ($user->hasPermissions('admin')): ?>
                    <h5>You are admin!</h5>
                 <? endif; ?>

             <? else: ?>
                 <a class="btn btn-primary btn-lg" href="register.php" role="button">Зарегистрироваться</a>

            <? endif; ?>

        </div>
      </div>
    </div>

<?php

$users = Database::getInstance()->query("SELECT * FROM users"); // вывожу всех пользователей

?>

    <div class="row">
      <div class="col-md-12">
        <h1>Пользователи</h1>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Дата</th>
            </tr>
          </thead>

        <?php foreach($users->results() as $user):?>
          <tbody>
            <tr>
              <td><?= $user->id;?></td>
              <td><a href="user_profile.php?id=<?= $user->id;?>"><?= $user->username;?></a></td>
              <td><?= $user->email;?></td>
              <td><?= $user->time;?></td>
            </tr>
          </tbody>
          <?php endforeach;?>

        </table>
      </div>
    </div>
  </div>
<br><br>
</body>
</html>