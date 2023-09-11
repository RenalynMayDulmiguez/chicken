<?php


function addToCart()
{
    global $con;
    $id = $_SESSION['id'];
    $getCart = $con->prepare('SELECT COUNT(*) as count, quantity, id, deleted_at FROM carts WHERE product_id = ? AND user_id = ?');
    $getCart->bind_param('ii', $_POST['product_id'], $id);
    $getCart->execute();
    $cart = $getCart->get_result()->fetch_assoc();
    if($cart['count'] >= 1 && $cart['deleted_at'] == null) {
        $quantity = $cart['quantity'];
        $quantity += 1;
        $updateQuery = $con->prepare('UPDATE carts SET quantity = ? WHERE id = ?');
        $updateQuery->bind_param('ii', $quantity, $cart['id']);
        $updateQuery->execute();
        if ($updateQuery->affected_rows >= 1) {
            echo 1;
            exit();
        } else {
            echo 0;
            exit();
        }
    }
   
    $query = $con->prepare('CALL addToCart(?,?)');
    $query->bind_param('ii', $id, $_POST['product_id']);
    $query->execute();
    if ($query->affected_rows >= 1) {
        echo 1;
    } else {
        echo 0;
    }
    $query->close();
}

function displayCarts()
{
    global $con;
    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    $query = $con->prepare('CALL displayCarts(?)');
    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result();
    $data = [];
    while ($r = $result->fetch_assoc()) {
        $r['images'] = json_decode($r['images']);
        $r['mainImage'] = $r['images'][0];
        $r['total'] = $r['price'] * $r['quantity'];
        $data[] = $r;
    }

    if (count($data) >= 1) {
        echo json_encode($data);
    } else {
        echo $query->error;
    }
    $query->close();
    }


 
}


function updateQuantity()
{
    global $con;

    $sql = 'CALL updateQuantity(?,?)';
    $query = $con->prepare($sql);
    $query->bind_param('ii', $_POST['quantity'], $_POST['id']);
    $query->execute();
    if ($query->affected_rows >= 1) {
        echo 1;
    } else {
        echo 0;
    }
    $query->close();
}

function removeCart()
{
    global $con;
    $sql = 'UPDATE carts SET deleted_at = NOW() WHERE id = ?';
    $query = $con->prepare($sql);
    $query->bind_param('i', $_POST['id']);
    $query->execute();
    if ($query->affected_rows >= 1) {
        echo 1;
    } else {
        echo 0;
    }
    $query->close();
}
