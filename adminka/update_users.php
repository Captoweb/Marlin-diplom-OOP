<?php
require_once '../init.php';

$id = $_GET['id'];

$users = Database::getInstance()->get('users', ['id', '=', $id]); // выводим всех пользователей по id

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
]);

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        if($validate->passed()) {
            $user->update(['username' => Input::get('username')], $id);
            $user->update(['status' => Input::get('status')], $id);

            Redirect::to("index.php");
        } else {
            foreach($validate->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}
?>


