<?php

function getAllMyCart()
{
    global $con;
    $userId = $_POST['user_id'];

    $sql = selectAllMyCart();
    $query = $con->prepare($sql);
    $query->bind_param('i', $userId);
    $query->execute();
    $result = $query->get_result();
    $data = [];
    while ($r = $result->fetch_assoc()) {
        $data[] = $r;
    }

    echo json_encode($data);

    $query->close();
}

function sentToTransaction()
{
    global $con;
    $cartId = $_POST['cartId'];
    $userId = $_POST['user_id'];
    $paymentMethod = $_POST['paymentMethod'];

    $file = $_FILES['proofRecient'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $upload_path = '';
    if (move_uploaded_file($fileTmpName, '../uploads/products/' . $fileName)) {
        $upload_dir = '../uploads/products/';
        $upload_path = $upload_dir . $fileName;
    } else {
        echo "File upload failed.";
    }

    $sql = sentToTransactionQuery();
    $query = $con->prepare($sql);
    $query->bind_param('iisi', $userId, $paymentMethod, $upload_path, $cartId);
    $query->execute();
    $result = $query->get_result();

    if (!$result) {
        echo 200;
    } else {
        echo 401;
    }

    $query->close();
}

function deleteThisCart()
{
    global $con;
    $cartId = $_POST['cartId'];

    $sql = deleteThisCartQuery();
    $query = $con->prepare($sql);
    $query->bind_param('i', $cartId);
    $query->execute();
    $result = $query->get_result();

    if (!$result) {
        echo 200;
    } else {
        echo 401;
    }

    $query->close();
}

//Wala pani mahuman
function adminDashboardViewPaidFunction()
{
    global $con;

    $sql = adminDashboardViewPaidQuery();
    $query = $con->prepare($sql);
    $query->execute();
    $result = $query->get_result();
    $data = [];
    while ($r = $result->fetch_assoc()) {
        $data[] = $r;
    }

    echo json_encode($data);


    $query->close();
}

function adminDashboardNoPaidPaidFunction()
{
    global $con;

    $sql = adminDashboardNoPaidPaidQuery();
    $query = $con->prepare($sql);
    $query->execute();
    $result = $query->get_result();
    $data = [];
    while ($r = $result->fetch_assoc()) {
        $data[] = $r;
    }

    echo json_encode($data);


    $query->close();
}

function adminDashboardDeliveredPaidFunction()
{
    global $con;

    $sql = adminDashboardDeliveredPaidQuery();
    $query = $con->prepare($sql);
    $query->execute();
    $result = $query->get_result();
    $data = [];
    while ($r = $result->fetch_assoc()) {
        $data[] = $r;
    }

    echo json_encode($data);

    $query->close();
}


function selectAllMyCart()
{
    return "SELECT c.id as cartId, c.quantity as cartQuantitty, p.*, u.myQrCode FROM `carts` as c INNER JOIN `products` as p INNER JOIN `users` as u ON c.product_id = p.id AND c.user_id = u.id WHERE c.user_id = ?";
}

function deleteThisCartQuery()
{
    return "DELETE FROM `carts` WHERE id = ?";
}

function sentToTransactionQuery()
{
    return "INSERT INTO `transaction`(`product_id`, `seller_id`, `buyer_id`, `transaction_amount`, `paymentMethod`, `proofOfQRcode`) SELECT p.id, p.user_id as seller_id, ? as buyer_id, SUM(p.price * c.quantity) as transaction_amount, ? as paymentMethod, ? as proofOfQRcode FROM `products` AS p INNER JOIN `carts` AS c ON c.product_id = p.id WHERE c.id = ?";
}

function adminDashboardViewPaidQuery(){
    return "SELECT SUM(transaction_amount) AS paid FROM `transaction` WHERE !`proofOfQRcode`";
}

function adminDashboardNoPaidPaidQuery(){
    return  "SELECT COUNT(*) AS notPaid FROM `transaction` WHERE `proofOfQRcode`";
}

function adminDashboardDeliveredPaidQuery(){
    return  "SELECT COUNT(*) AS deliveryStatus FROM `transaction` WHERE `deliver_status` = 1";
}