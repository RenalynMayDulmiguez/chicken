<?php
$con = new mysqli('localhost', 'root', '', 'chicken_db');
$method = $_POST['method'];
require('./user-api.php');
session_start();

$_POST['user_id'] = $_SESSION['id'];

require('./cart-api.php');
require('./product-api.php');
require('./favorite-api.php');
require('./upload.php');
require('./checkoutItem.php');

if (function_exists($method)) {
  call_user_func($method);
} else {
  echo 'Function not found!';
}
