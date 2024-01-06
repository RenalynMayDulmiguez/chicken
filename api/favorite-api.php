<?php

function displayMyProductFavorites()
{
    global $con;
    $user_id = $_POST['user_id'];
    $sql = "SELECT p.*, f.id as fid FROM favorites AS f INNER JOIN products as p ON f.product_id = p.id WHERE f.user_id = ?";
    $query = $con->prepare($sql);
    $query->bind_param('i', $user_id);
    $query->execute();
    $result = $query->get_result();
    $data = [];

    while ($r = $result->fetch_assoc()) {
        $r['images'] = json_decode($r['images']);
        $r['mainImage'] = $r['images'][0];
        $data[] = $r;
    }

    echo json_encode($data);

    $query->close();
}

function addToMyFavorite()
{
    global $con;
    $user_id = $_POST['user_id'];
    $product = $_POST['product'];

    // Check if the combination of user_id and product already exists
    $check_sql = "SELECT COUNT(*) AS count FROM `favorites` WHERE `user_id` = ? AND `product_id` = ?";
    $check_query = $con->prepare($check_sql);
    $check_query->bind_param('ii', $user_id, $product);
    $check_query->execute();
    $result = $check_query->get_result();
    $row = $result->fetch_assoc();

    // If the combination exists, do not insert again
    if ($row['count'] > 0) {
        echo 409; 
    } else {
        // Insert the combination if it doesn't exist
        $insert_sql = "INSERT INTO `favorites`(`user_id`, `product_id`) VALUES (?,?)";
        $insert_query = $con->prepare($insert_sql);
        $insert_query->bind_param('ii', $user_id, $product);
        $insert_query->execute();

        if ($insert_query->affected_rows >= 1) {
            echo 200; // OK - Indicates successful insertion
        } else {
            echo 401; // Unauthorized or insertion failed
        }
    }
}
function addToCartFromFavorites()
{
    global $con;
    $pId = $_POST['pid'];
    $Uid = $_POST['user_id'];


    $sql = "INSERT INTO carts(`product_id`) SELECT ? FROM `favorites` AS f WHERE f.id = ?";
    $query = $con->prepare($sql);
    $query->bind_param('ii', $pId, $Uid);
    $query->execute();

    if ($query->affected_rows >= 1) {
        echo 200;
    } else {
        echo 401;
    }
}


function removeFavorite()
{
    global $con;
    $query = $con->prepare('DELETE FROM favorites WHERE id = ?');
    $query->bind_param('i', $_POST['id']);
    $query->execute();

    if ($query->affected_rows >= 1) {
        echo 1;
    } else {
        echo 0;
    }
}
