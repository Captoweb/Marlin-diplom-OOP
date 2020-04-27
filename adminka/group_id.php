<?php
require_once '../init.php';

$id = $_GET['id'];

$users = Database::getInstance()->update('users', $id, [  // назначить админом
    'group_id' => 2

]);

Redirect::to('index.php');


?>




