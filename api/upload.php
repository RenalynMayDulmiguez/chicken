<?php

function addProduct() {
  global $con;
  // Retrieve the uploaded files
$products = $_FILES['products'];
$imagePlaceholder = [];

// Loop through each product file
for ($i = 0; $i < count($products['name']); $i++) {
    // Generate a random number
    $random_number = mt_rand(10000, 99999);
    $file_extension = pathinfo($products['name'][$i], PATHINFO_EXTENSION);
    // Create a new random name for the product
    $product_name = "product-" . $_POST['name'] . "-" . $random_number . "." . $file_extension;

    $product_tmp_name = $products['tmp_name'][$i];
    $product_error = $products['error'][$i];

    // Check for any errors during upload
    if ($product_error === UPLOAD_ERR_OK) {
        // Specify the directory to save the uploaded files
        $upload_dir = '../uploads/products/';
        $upload_path = $upload_dir . $product_name;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($product_tmp_name, $upload_path)) {
          array_push($imagePlaceholder, $product_name);
        } else {
            echo "Failed to upload product '$product_name'.<br>";
            return 0;
        }
    } else {
        echo "Error uploading product '$product_name': ";
        switch ($product_error) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "File size is too large.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "File was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "No file was uploaded.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Missing temporary folder.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Failed to write file to disk.";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "File upload stopped by extension.";
                break;
            default:
                echo "Unknown error.";
                break;
        }
    }
}

  $query = $con->prepare('CALL addProduct(?,?,?,?,?,?)');
  $images = json_encode($imagePlaceholder);
  $id = (int)$_SESSION['id'];
  $query->bind_param('issids',$id , $_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['price'], $images);
  $query->execute();
  if($query->affected_rows >= 1) {
    echo 1;
  } else {
    echo 'Something went wrong please try again!';
  }
  $query->close();
}