<?php
require_once '../init.php';

$user = new User;

$users = Database::getInstance()->query("SELECT * FROM users"); // вывожу всех пользователей

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Users</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
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
            <a class="nav-link" href="../index.php">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Управление пользователями</a>
          </li>
        </ul>

        <ul class="navbar-nav">

            <? if ($user->isLoggedIn()): ?>
                <li class="nav-item"><a class="nav-link" href='#'>Hi, <?= $user->data()->username; ?></a></li>
                <li class="nav-item"><a class="nav-link" href='../logout.php'> Logout</a></li>
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
   <? $user = new User;
     $users = Database::getInstance()->query("SELECT * FROM users"); ?>

    <div class="container">
      <div class="col-md-12">
        <h1>Пользователи</h1>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Действия</th>
            </tr>
          </thead>
            <?php foreach($users->results() as $user):?>
          <tbody>
            <tr>
              <td><?= $user->id;?></td>
              <td><?= $user->username;?></td>
              <td><?= $user->email;?></td>
              <td>
                <? if ($user->group_id == '1'): ?>
              	<a href="group_id.php?id=<?= $user->id;?>" class="btn btn-success">Назначить администратором</a>
                <? else: ?>
                 <a href="group_id1.php?id=<?= $user->id;?>" class="btn btn-danger">Уволить</a>
                <? endif; ?>
                <a href="show.php?id=<?= $user->id;?>" class="btn btn-info">Посмотреть</a>
                <a href="edit_users.php?id=<?= $user->id;?>" class="btn btn-warning">Редактировать</a>
                <a href="delete.php?id=<?= $user->id;?>" class="btn btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>

              </td>
            </tr>
          </tbody>
          <?php endforeach;?>
        </table>

      </div>
    </div>  
  </body>
</html>
