<?php 
$con = new mysqli('localhost', 'root', '', 'chicken_db');
$method = $_POST['method'];
session_start();

require('./user-api.php');
require('./cart-api.php');
require('./product-api.php');
require('./favorite-api.php');
require('./upload.php');

if(function_exists($method)) {
  call_user_func($method);
} else {
  echo 'Function not found!';
}

?>