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


    $sql = "INSERT INTO `favorites`(`user_id`, `product_id`) VALUES (?,?)";
    $query = $con->prepare($sql);
    $query->bind_param('ii', $user_id, $product);
    $query->execute();

    if ($query->affected_rows >= 1) {
        echo 200;
    }else{
        echo 401;
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
