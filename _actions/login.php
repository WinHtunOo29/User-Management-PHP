<?php

session_start();

include('../vendor/autoload.php');

use Libs\Database\MYSQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$email = $_POST['email'];
$password = md5($_POST['password']);
$table = new UsersTable(new MYSQL());
$user = $table->findByEmailAndPassword($email, $password);

if($user) {
    $_SESSION['user'] = $user;
    HTTP::redirect('/profile.php');
    if($table->suspend($user->id)) {
        HTTP::redirect('/index.php', 'suspended=1');
    }
} else {
    HTTP::redirect('/index.php', 'incorrect=1');
}