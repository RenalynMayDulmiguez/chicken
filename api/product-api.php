<?php 

function displayProducts() {
  global $con;
  $query = $con->prepare("CALL displayProducts");
  $query->execute();
  $result = $query->get_result();
  $data = [];

  while($r = $result->fetch_assoc()) {
    $r['images'] = json_decode($r['images']);
    $r['mainImage'] = $r['images'][0];
    $data[] = $r;
  }

  echo json_encode($data);
  $query->close();

}

function favorites() {
  global $con;
  $user_id = $_SESSION['id'];
  $product_id = $_POST['id'];

  $sql = 'CALL updateFavorites(?,?)';
  $query = $con->prepare($sql);
  $query->bind_param('ii', $user_id, $product_id);
  $query->execute();

  if($query->affected_rows >= 1) {
    echo 1;
  }
}

function deleteProduct() {
  global $con;
  $query = $con->prepare('CALL deleteProduct(?)');
  $query->bind_param('i', $_POST['id']);
  $query->execute();
  if($query->affected_rows >= 1) {
    echo 1;
  } else {
    echo 0;
  }
  $query->close();
}

function editProduct() {
  global $con;
  $id = $_POST['id'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];

  $sql = 'CALL updateProduct(?, ?, ?)';
  $query = $con->prepare($sql);
  $query->bind_param('iii', $id, $quantity, $price);
  $query->execute();

  if ($query->affected_rows >= 1) {
    echo 1;
  } else {
    echo 0;
  }

  $query->close();
}
