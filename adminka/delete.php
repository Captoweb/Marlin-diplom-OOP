<?php
require_once '../init.php';

$id = $_GET['id'];

Database::getInstance()->delete('users', ['id', '=', $id]); // удаляет

Redirect::to('index.php');