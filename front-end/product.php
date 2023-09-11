<?php 
include './shared/head.php'; 
$con = new mysqli('localhost', 'root', '', 'chicken_db');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$product_id = $_GET['product_id'];
$query = $con->prepare("SELECT * FROM products WHERE id = ?");
$query->bind_param('i', $product_id);
$query->execute();
$result = $query->get_result();
$product = $result->fetch_assoc();
$images = json_decode($product['images']);
?>

<div id="app">
  <?php 
  include './shared/header.php'; 
  include './shared/mobile-header.php';
 ?>


  <!-- Product Left Sidebar Start -->
  <section class="product-section">
    <div class="container-fluid-lg">
      <div class="row g-4">
        <div class="col-xl-6">
          <div class="product-left-box">
            <div class="row g-sm-4 g-2">
              <?php for($i = 0; $i < count($images); $i++) { ?>
                <div  class="col-6 col-grid-box wow fadeInUp">
                <div class="slider-image">
                  <img src="../uploads/products/<?= $images[$i] ?>" 
                   data-zoom-image="../uploads/products/<?= $images[$i] ?>" 
                    class="img-fluid image_zoom_cls-0 lazyload"
                    alt="image">
                </div>
              </div>
              <?php } ?>
           
            </div>
          </div>
        </div>

        <div class="col-xl-6">
          <div class="right-box-contain p-sticky wow fadeInUp">
            <h2 class="name"><?= $product['name'] ?></h2>
            <div class="price-rating">
              <h3 class="theme-color price">₱<?=  $product['price'] ?>
              </h3>
            </div>
            <div class="procuct-contain">
              <p><?=  $product['description'] ?>
              </p>
            </div>
            <div class="note-box product-packege">
              <button href="#!"
                class="btn btn-md bg-dark cart-button text-white w-100" @click="addToCart(<?= $product_id ?>)">Add To
                Cart</button>
            </div>

            <div class="buy-box">
              <a href="javascript:void(0)" @click="favorites(<?= $product_id ?>)">
                <i data-feather="heart"></i>
                <span>Add To Wishlist</span>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- Product Left Sidebar End -->
</div>


<?php
  include './shared/footer.php';
   include './shared/scripts.php'; ?>
<script src="../src/product.js"></script>
</body>

</html>