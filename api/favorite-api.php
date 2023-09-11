<?php

function displayFavorites()
{
    global $con;
    $user_id = $_SESSION['id'];
    $sql = 'CALL displayFavorites(?)';
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
    // echo 1;
    $query->close();
}

function addToCartFromFavorites()
{
    global $con;
    $user_id = $_SESSION['id'];
    $product = json_decode($_POST['product']);


    $sql = 'CALL addToCartFromFavorites(?,?,?)';
    $query = $con->prepare($sql);
    $query->bind_param('iii', $user_id, $product->id, $product->product_id);
    $query->execute();
    if ($query->affected_rows >= 1) {
        echo 1;
    }
}


function removeFavorite() {
    global $con;
    $query = $con->prepare('DELETE FROM favorites WHERE id = ?');
    $query->bind_param('i', $_POST['id']);
    $query->execute();
    if($query->affected_rows >= 1) {
        echo 1;
    } else {
        echo 0;
    }

}
