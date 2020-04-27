<?php
require_once 'init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();

        $validate->check($_POST, [
            'email' => ['required'=>true, 'email'=>true],
            'password' => ['required'=>true]
        ]);

        if($validate->passed()) {
            $user = new User;
            $remember = (Input::get('remember')) === 'on' ? true : false;

            $login = $user->login(Input::get('email'), Input::get('password'), $remember);

            if($login) {
                Redirect::to('index.php');
            } else {
                Session::flash('failed', '<div class="alert alert-info" role="alert">Логин или пароль неверны</div>');
            }
        } else {
            foreach ($validate->errors() as $error) {
                 $error . '<br>';
            }
        }
    }
}

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="text-center">

<form  action="" method="post" class="form-signin" onsubmit = "return validate();">
    <img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    <?php echo Session::flash('failed'); ?>
    <div class="alert alert-danger hidden">
        <ul>
            <li class="mess"></li>
            <li  class="mess2"></li>
        </ul>
    </div>


    <div class="form-group">
        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo Input::get('email')?>">
    </div>
    <div class="form-group">
        <input type="text" name="password" class="form-control" id="password" placeholder="Пароль">
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember"> Запомнить меня
        </label>
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>

<script src="validate.js"></script>
</body>
</html>
