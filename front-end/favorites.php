<?php include './shared/head.php'; ?>

<div id="app">

  <?php

    include './shared/header.php';
    include './shared/mobile-header.php';
    ?>

  <!-- Breadcrumb Section Start -->
  <section class="breadscrumb-section pt-0">
    <div class="container-fluid-lg">
      <div class="row">
        <div class="col-12">
          <div class="breadscrumb-contain">
            <h2>Favorites</h2>
            <nav>
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="index.php">
                    <i class="fa-solid fa-house"></i>
                  </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Favorites
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- Wishlist Section Start -->
  <section class="wishlist-section section-b-space">
    <div class="container-fluid-lg">
      <div class="row g-sm-3 g-2">
        <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">
          <div v-for="product in products" class="product-box-3 h-100">
            <div class="product-header">
              <div class="product-image">
                <a href="`product.php?product_id=${product.product_id}`">
                  <img :src="`../uploads/products/${product.mainImage}`"
                    class="img-fluid lazyload" alt="">
                </a>

                <div class="product-header-top">
                  <button class="btn wishlist-button close_button" @click="removeFavorite(product.id)">
                    <i data-feather="x"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="product-footer">
              <div class="product-detail">
                <a>
                  <h5 class="name">
                    {{product.name}}
                  </h5>
                </a>
                <h5 class="price">
                  <span class="theme-color">
                    {{product.price}}
                  </span>
                </h5>

                <div class="add-to-cart-box bg-white mt-2">
                  <button @click="addToCartFromFavorites(product)"
                    class="btn btn-add-cart addcart-button">Add
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Wishlist Section End -->

  <!-- Footer Section Start -->
  <?php include './shared/footer.php' ?>
  <!-- Footer Section End -->

</div>
<?php include './shared/scripts.php'; ?>
<script src="../src/favorite.js"></script>
</body>

</html>