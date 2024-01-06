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

    $sql = "SELECT * FROM users WHERE id = ?";
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


function UpdateProfile(){
    global $con;

    $id = $_SESSION['id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    $sql = "UPDATE `users` SET `username`= ? ,`fullname`= ?, `address`= ?,`mobile`= ?,`email`= ? WHERE `id`= ?";
    $query = $con->prepare($sql);
    $query->bind_param('sssssi', $username, $fullname, $address, $mobile, $email, $id);
    $query->execute();

    if($query->affected_rows > 0){
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['address'] = $address;
        $_SESSION['mobile'] = $mobile;
        $_SESSION['email'] = $email;
        echo 200; // Successful update
    }else{
        echo 400; // Update failed
    }

    $query->close();
}


