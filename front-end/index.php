<?php 
 session_start();
include './shared/head.php'; 
?>

<div id="app">
  <?php 
  include './shared/header.php';
  include './shared/mobile-header.php';
  ?>

  <!-- Home Section Start -->
  <div class="swiper-container mx-auto mt-8 rounded-lg shadow-lg bg-white overflow-hidden">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide relative">
                <div class="image-container">
                    <img src="../assets/images/chickenback.jpg" alt="Slide 1" class="w-full h-full object-cover">
                    <div class="image-text">
                        <p class="text-lg font-semibold">Crispy & Fried</p>
                        <p class="mt-2 text-uppercase">Fried Chicken</p>
                        <p class="mt-2 text-uppercase">Your favorite Crispy Fried Chicken </p>
                        <a href="#product-area" class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">Order Now<i class="fa-solid fa-right-long ms-2"></i></a>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide relative">
                <div class="image-container">
                    <img src="../assets/images/chick2.jpg" alt="Slide 2" class="w-full h-full object-cover">
                    <div class="image-text">
                        <p class="text-lg font-semibold text-uppercase">We'll Fry Your Crispy</p>
                        <p class="mt-2 text-uppercase">Juicy Chicken</p>
                        <p class="mt-2 text-uppercase">and with every bite explodes</p>
                        <p class="mt-2 text-uppercase">with juicy flavors!</p>
                        <a href="#product-area" class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">Order Now<i class="fa-solid fa-right-long ms-2"></i></a>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide relative">
                <div class="image-container">
                    <img src="../assets/images/makapasmo.jpg" alt="Slide 4" class="w-full h-full object-cover">
                    <div class="image-text">
                        <p class="text-lg font-semibold" > With other alternative products</p>
                        <p class="mt-2 text-uppercase" >to satisfy your street</p>
                        <p class="mt-2 text-uppercase"> food cravings such as</p>
                        <p class="text-uppercase"> Fried Lumpia, Siomai, and Many more!</p>
                        <a href="#product-area" class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">Order Now<i class="fa-solid fa-right-long ms-2"></i></a>
                    </div>
                </div>
            </div>
    
                <!-- Slide 4 -->
            <div class="swiper-slide relative">
                <div class="image-container">
                    <img src="../assets/images/makagutom.jpg" alt="Slide 3" class="w-full h-full object-cover">
                    <div class="image-text">
                        <p class="text-lg font-semibold text-uppercase">Refreshing Drinks</p>
                        <p class=" mt-2 text-uppercase">Carbonated Drinks</p>
                        <p class=" mt-2 text-uppercase">We also have soft drinks</p>
                        <p class=" mt-2 text-uppercase"> juice to cleanse your palate</p>
                        <p class=" mt-2 text-uppercase"> after eating!</p>
                        <a href="#product-area" class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">Order Now<i class="fa-solid fa-right-long ms-2"></i></a>
                    </div>
                </div>
            </div>
            </div>
          

    <div class="swiper-pagination swiper-pagination-custom"></div>

  <!-- Home Section End -->

  <!-- Product Section Start -->
  <section class="mb-5">
    <div class="container-fluid-lg">
      <div class="row g-3">
        <div class="col-12">
          <div class="text-center font-bold "  id="product-area">
            <div>
              <h2 class="text-3xl font-bold inline-block">OUR MENU</h2>
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

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination-custom',
            clickable: true,
        },
        autoplay: {
            delay: 2000, // Autoplay delay in milliseconds (4 seconds)
            disableOnInteraction: false, // Prevents autoplay from stopping when the user interacts with the carousel
        },
    });
</script>
</body> 

</html>