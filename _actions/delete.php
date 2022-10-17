<?php

include('../vendor/autoload.php');

use Libs\Database\MYSQL;
use Libs\Database\UsersTable;
use Helpers\Auth;
use Helpers\HTTP;

$auth = Auth::check();
$table = new UsersTable(new MYSQL());
$id = $_GET['id'];
$table->delete($id);
HTTP::redirect('/admin.php');