<?php
$con = new mysqli('localhost', 'root', '', 'chicken_db');
$method = $_POST['method'];
session_start();
if (function_exists($method)) {
    call_user_func($method);
} else {
    echo 'Function not found!';
}

function login()
{

    global $con;
    $username = strtolower($_POST['username']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $query = $con->prepare($sql);
    $query->bind_param('ss', $username, $password);
    $query->execute();
    $user = $query->get_result();
    $query->close();
    $role = null;
    $status = null;

    while ($row = $user->fetch_assoc()) {
        $role = $row['role'];
        $status = $row['status'];
        $_SESSION['id'] = $row['id'];
    }

    if ($status < 3) {
        echo $role;
    } else {
        echo 0;
    }
}

function register()
{

    global $con;

    $fullname = $_POST['fullname'];
    $username = strtolower($_POST['username']);
    $password = md5($_POST['password']);
    $email = strtolower($_POST['email']);
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];

    $file = $_FILES['qrcode'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    $upload_path = '';
    if (move_uploaded_file($fileTmpName, '../uploads/products/' . $fileName)) {
        $upload_dir = '../uploads/products/';
        $upload_path = $upload_dir . $fileName;
    } else {
        echo "File upload failed.";
    }

    $sql = 'CALL register(?,?,?,?,?,?,?)';
    $query = $con->prepare($sql);
    $query->bind_param('sssssss', $fullname, $username, $email, $password, $address, $mobile, $upload_path);
    $query->execute();
    if ($query->affected_rows >= 1) {
        login();
    } else {
        echo 0;
    }
}


function changePasswordProfile(){
    global $con;

    $id = $_SESSION['id'];
    $currentPassword = md5($_POST['currentPassword']);
    $confirmPassword = md5($_POST['confirmPassword']);

    $sql = "UPDATE `users` SET `password` = ? WHERE `password` = ? AND `id` = ?";
    $query = $con->prepare($sql);
    $query->bind_param('ssi', $confirmPassword, $currentPassword, $id);
    $query->execute();
    $user = $query->get_result();
    $query->close();

    if(!$user){
        echo 200;
    }else{
        echo 400;
    }
}
