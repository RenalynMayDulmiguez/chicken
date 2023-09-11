<?php
function updateCounterlock()
{
    global $con;

    $user_id = $_POST['userId'];
    $counterlock = $_POST['counterlock'];

    $sql = 'CALL updateCounterlock(?,?)';
    $query = $con->prepare($sql);
    $query->bind_param('ii', $user_id, $counterlock);
    $query->execute();
    if($query->affected_rows >= 1) {
        echo 1;
    } else {
        echo 0;
    }

    $query->close();
    
}

function displayAllUser()
{
    global $con;

    $sql = 'CALL displayAllUser';
    $query = $con->prepare($sql);
    $query->execute();
    $result = $query->get_result();
    $data = array();
    while ($r = $result->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}




function displayUser()
{
    global $con;
    $user_id = $_SESSION['id'];

    $sql = `CALL displayUser(?)`;
    $query = $con->prepare($sql);
    $query->bind_param('i', $user_id);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
    echo json_encode($result);
    $query->close();
}

function login()
{

    global $con;
    $username = strtolower($_POST['username']);
    $password = md5($_POST['password']);

    $sql = 'CALL login(?)';
    $query = $con->prepare($sql);
    $query->bind_param('s', $username);
    $query->execute();
    $user = $query->get_result()->fetch_assoc();
    $query->close();
    // echo json_encode($user);
    if($user['counterlock'] >= 3){
        echo 'locked';
        exit();
    }
    if ($user != null) {
        if ($password == $user['password']) {
            $_SESSION['user'] = $user;
            $_SESSION['id'] = $user['id'];
            echo $user['role'];
        } else {
            $counterlock = (int)$user['counterlock'] + 1;
            $user_id = (int)$user['id'];
            $query2 = $con->prepare("UPDATE users SET counterlock = ? WHERE id = ?");
            $query2->bind_param('ii', $counterlock, $user_id );
            $query2->execute();
            $query2->close();
        }
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


    $sql = 'CALL register(?,?,?,?,?,?)';
    $query = $con->prepare($sql);
    $query->bind_param('ssssss', $fullname, $username, $email, $password, $address, $mobile);
    $query->execute();
    if ($query->affected_rows >= 1) {
        login();
    } else {
        echo 0;
    }
}

function fnUpdate()
{
    global $con;
    $id = $_SESSION['userId'];
    $username = strtolower($_POST['username']);
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = strtolower($_POST['email']);

    $sql = 'UPDATE users SET username = ?, fullname = ?, address = ?, mobile = ?, email = ?, updated_at = NOW() WHERE id = ?';
    $query = $con->prepare($sql);
    if ($query === false) {
        echo "Prepare failed: " . $con->error;
        return;
    }

    $query->bind_param('sssssi', $username, $fullname, $address, $mobile, $email, $id);

    if ($query->execute()) {
        // Update the session variables after successful update
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['address'] = $address;
        $_SESSION['mobile'] = $mobile;
        $_SESSION['email'] = $email;

        echo 1;
    } else {
        echo "There was an error: " . $query->error;
    }
}


function fnChangePassword() {
    global $con;
    // Retrieve the user ID from the session
    $userid = $_SESSION['userId'];
  
    // Retrieve the current password and new password from the POST request
    $currentPassword = md5($_POST['currentPassword']);
    $newPassword = md5($_POST['newPassword']);
    $confirmPassword = md5($_POST['confirmPassword']);

    // Validate the new password and confirm password
    if ($newPassword !== $confirmPassword) {
      echo 'passwordMismatch'; // New password and confirm password do not match
      exit;
    }
  
    // Retrieve the current password from the database
    $query = $con->prepare('SELECT password FROM users WHERE id = ?');
    $query->bind_param('i', $userid);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
  
    // Compare the current password with the one retrieved from the database
    if (!$result || $currentPassword !== $result['password']) {
      echo 'currentPasswordMismatch'; // Current password does not match
      exit;
    }
  
    // Update the password in the database
    $query = $con->prepare('UPDATE tbl_users SET password = ? WHERE id = ?');
    $query->bind_param('si', $newPassword, $userid);
  
    if ($query->execute()) {
      echo 'success'; // Password updated successfully
    } else {
      echo 'error'; // Error updating the password
    }
}
function deleteUser() {
    global $con;
    $id = $_POST['userId'];
    $query = $con->prepare('UPDATE users SET deleted_at = NOW() WHERE id = ?');
    $query->bind_param('i', $id);
    $query->execute();
    $query->close();
    $con->close();
}
function editUser()
{
    global $con;

    $userId = $_POST['userId'];
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];
    $email = strtolower($_POST['email']);

    $sql = 'UPDATE users SET fullname = ?, mobile = ?, email = ?, updated_at = NOW() WHERE id = ?';
    $query = $con->prepare($sql);
    $query->bind_param('sssi', $fullname, $mobile, $email, $userId);
    $query->execute();

    if ($query->affected_rows >= 1) {
        echo 1;
    } else {
        echo 0;
    }

    $query->close();
}
