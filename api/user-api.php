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
    if ($query->affected_rows >= 1) {
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


function fnUpdate()
{
    global $con;
    $id = $_SESSION['id'];
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


function fnChangePassword()
{
    global $con;

    // Retrieve the user ID from the session
    $id = $_SESSION['id'];

    // Retrieve the current password and new password from the POST request
    $currentPassword = md5($_POST['currentPassword']);
    $newPassword = md5($_POST['newPassword']);
    $confirmPassword = md5($_POST['confirmPassword']);

    // Validate the new password and confirm password
    if ($newPassword !== $confirmPassword) {
        echo 'passwordMismatch';
        exit;
    }

    // Retrieve the current password from the database
    $query = $con->prepare('SELECT password FROM users WHERE id = ?');
    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();

    // Compare the current password with the one retrieved from the database
    if (!$result || $currentPassword !== $result['password']) {
        echo 'currentPasswordMismatch';
        exit;
    }

    // Update the password in the database
    $query = $con->prepare('UPDATE users SET password = ? WHERE id = ?');
    $query->bind_param('si', $newPassword, $id);

    if ($query->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}

function deleteUser()
{
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
