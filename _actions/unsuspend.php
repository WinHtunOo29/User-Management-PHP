<?php

include('../vendor/autoload.php');

use Libs\Database\MYSQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;
use Helpers\Auth;

$auth = Auth::check();
$table = new UsersTable(new MYSQL());
$id = $_GET['id'];
$table->unsuspend($id);

HTTP::redirect('/admin.php');