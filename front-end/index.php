<?php 
include './shared/head.php'; 
?>

<div id="app">
  <?php 
  include './shared/header.php';
  include './shared/mobile-header.php';
  ?>

  <!-- Home Section Start -->
  <section class="home-section home-section-ratio pt-2">
    <div class="container-fluid-lg">
      <div class="row g-4">
        <div class="col-xxl-3 col-lg-4 col-sm-6 ratio_180 d-sm-block d-none">
          <div class="home-contain rounded">
            <div class="h-100">
              <img src="../assets/chick-img/bg1.jpeg"
                class="bg-img blur-up lazyload" alt="">
            </div>
            <div class="home-detail p-top-left home-p-medium">
              <div>
                <h6 class="text-danger mb-2 fw-bold">Crispy & Fried</h6>
                <h2 class="theme-color fw-bold">Fried Chicken</h2>
                <p class="text-content d-md-block d-none text-white">Your favorite Crispy Fried Chicken and with every bite explodes with juicy flavors!</p>
                <a href="#product-area"
                  class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">Order
                  Now
                  <i class="fa-solid fa-right-long ms-2"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xxl-6 col-lg-8 order-xxl-0 ratio_87">
          <div class="home-contain rounded">
            <div class="h-100">
              <img src="../assets/chick-img/bg2.jpeg"
                class="bg-img blur-up lazyload" alt="">
            </div>
            <div class="home-detail p-center-left home-p-sm">
              <div>
                
                <h1 class="w-75 text-uppercase name-title text-white poster-2 my-2">
                  we'll fry your Crispy</span> 
                  <h1 class="w-75 text-uppercase name-title text-white poster-2 my-2">Juicy Chicken</span>
                </h1>
                <p class="w-50 text-white">With other alternative products to satsify your street food cravings such as Fried Lumpia, Siomai and Many more!</p>
                <button onclick="location.href = '#product-area';"
                  class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">
                  Order Now <i
                    class="fa-solid fa-right-long icon ms-2"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div
          class="col-xxl-3 col-xl-4 col-sm-6 ratio_180 custom-ratio d-xxl-block d-lg-none d-sm-block d-none">
          <div class="home-contain rounded">
            <img src="../assets/chick-img/bg3.jpeg"
              class="bg-img blur-up lazyload" alt="">
            <div class="home-detail p-top-left home-p-medium">
              <div>
                <h6 class="text-danger mb-2 fw-bold">Refreshing Drinks</h6>
                <h2 class="w-75 text-uppercase name-title text-white poster-2 my-2">Carbonated Drinks</h2>
                <p class="text-content d-md-block d-none text-white">We also have soft drinks or juice to cleanse your pallet after eating!</p>
                <a href="#product-area"
                  class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">Order
                  Now
                  <i class="fa-solid fa-right-long ms-2"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Home Section End -->




  <!-- Product Section Start -->
  <section class="mb-5">
    <div class="container-fluid-lg">
      <div class="row g-3">
        <div class="col-12">
          <div class="title title-flex"  id="product-area">
            <div>
              <h2>Our Menu</h2>
              <span class="title-leaf">

              </span>
            </div>
          </div>


          <div class="row">
            <div v-for="product in products" class="col-md-3">
              <div class="product-box product-box-bg wow fadeInUp"
                data-wow-delay="0.1s">
                <div class="product-image">
                  <a :href="`product.php?product_id=${product.id}`">
                    <img :src="`../uploads/products/${product.mainImage}`"
                      class="img-fluid blur-up lazyload" alt="">
                  </a>
                  <ul class="product-option">

                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                      title="add to cart">
                      <a href="javascript:void(0)"
                        @click="addToCart(product.id)" class="notifi-wishlist">
                        <i data-feather="shopping-cart"></i>
                      </a>
                    </li>

                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                      title="Wishlist">
                      <a href="javascript:void(0)"
                        @click="favorites(product.id)" class="notifi-wishlist">
                        <i data-feather="heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="product-detail">
                  <a :href="`product.php?product_id=${product.id}`">
                    <h6 class="name">
                      {{ product.name }}
                    </h6>
                  </a>

                  <h5 class="sold text-content">
                    <span class="theme-color price">₱ {{ product.price }}</span>
                  </h5>

                  <div class="product-rating mt-2">
                    <h6 class="theme-color">Stock {{ product.quantity }}</h6>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Product Section End -->


  <?php include './shared/footer.php'; ?>
</div>

<?php include './shared/scripts.php'; ?>

<script src="../src/product.js"></script>

</body>

</html>