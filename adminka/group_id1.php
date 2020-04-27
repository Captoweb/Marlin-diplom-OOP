<?php
require_once '../init.php';

$id = $_GET['id'];

$users = Database::getInstance()->update('users', $id, [  // разжаловать админа
    'group_id' => 1

]);

Redirect::to('index.php');


?>




