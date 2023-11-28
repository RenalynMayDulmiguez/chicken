<header class="pb-0">
  <div class="header-top bg-dark">
    <div class="container-fluid-lg">
      <div class="row">
        <div class="col-xxl-3 d-xxl-block d-none">
          <div class="top-left-header">
            <i class="text-white me-2" data-feather="map-pin"></i>
            <span class="text-white">Sr.San Roque New Bridge Pusok Lapu Lapu
              City</span>
          </div>
        </div>

        <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
          <div class="header-offer">
            <div class="notification-slider">
              <div>
                <div class="timer-notification">
                  <strong class="me-1">Welcome to CFC - Crispy Fried Chicken
                    Order your favorite Crispy Fried Chicken now!</strong>
                </div>
              </div>
              <div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- sticky-header -->
  <div class="top-nav top-header p-2">
    <div class="container-fluid-lg">
      <div class="row">
        <div class="col-12">
          <div class="navbar-top">
            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
              <span class="navbar-toggler-icon">
                <i data-feather="menu"></i>
              </span>
            </button>
            <a href="index.php" class="nav-logo">
              <img src="../assets/images/friedlogo.jpg" class="img-fluid" width="100" alt="" />
            </a>
            <div class="rightside-box">
              <ul class="right-side-menu">
                <?php if (isset($_SESSION['id'])) : ?>
                  <li class="right-side d-block">
                    <a href="favorites.php" class="btn p-0 position-relative header-wishlist">
                      <i data-feather="heart"></i>
                      <span class="position-absolute top-0 start-100 translate-middle badge">
                        {{ favoritesLength }}
                        <span class="visually-hidden">unread messages</span>
                      </span>
                    </a>
                  </li>
                  <li class="right-side d-block">
                    <a href="myorders.php" class="btn p-0 position-relative header-wishlist">
                      My Orders
                      <span class="position-absolute top-0 start-100 translate-middle badge">
                        {{ orderLength }}
                      </span>
                    </a>
                  </li>
                  <li class="right-side">
                    <div class="onhover-dropdown header-badge">
                      <button type="button" class="btn p-0 position-relative header-wishlist">
                        <i data-feather="shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge">
                          {{ carts.length}}
                          <span class="visually-hidden">unread messages</span>
                        </span>
                      </button>
                      <div class="onhover-div">
                        <ul class="cart-list">
                          <li v-for="cart, i in carts" class="product-box-contain">
                            <div class="drop-cart">
                              <a :href="`product.php?product_id=${cart.product_id}`" class="drop-image">
                                <img :src="`../uploads/products/${cart.mainImage}`" class="lazyload" :alt="cart.mainImage" />
                              </a>

                              <div class="drop-contain">
                                <a href="product-left-thumbnail.html">
                                  <h5 class="text-capitalize">{{ cart.name }}</h5>
                                </a>
                                <h6>
                                  <span>{{ cart.quantity }} x</span>
                                  ₱ {{ cart.price }}
                                </h6>
                                <button class="close-button close_button" @click="removeCart(cart.id)">
                                  <i data-feather="x"></i>
                                </button>
                              </div>
                            </div>
                          </li>
                        </ul>

                        <div class="price-box">
                          <h5>Total :</h5>
                          <h4 class="theme-color fw-bold">{{ getTotal }}</h4>
                        </div>

                        <div class="button-group float-end">
                          <a href="checkout.php" class="btn btn-sm cart-button theme-bg-color text-white">Checkout Items</a>
                        </div>
                      </div>
                    </div>
                  </li>

                <?php endif; ?>
                <li class="right-side onhover-dropdown d-block">
                  <div class="delivery-login-box">
                    <div class="delivery-icon">
                      <i data-feather="user"></i>
                    </div>
                    <div class="delivery-detail">
                      <h6>Hello</h6>
                      <h5><?= isset($_SESSION['id']) ?  $_SESSION['user']['fullname']  : '' ?></h5>
                    </div>
                  </div>

                  <div class="onhover-div onhover-div-login ">
                    <ul class="user-box-name">

                      <?php if (isset($_SESSION['id']) &&  $_SESSION['id']) : ?>
                        <li class="product-box-contain">
                          <a href="../front-end/profile.php">Profile</a>
                        </li>
                        <li class="product-box-contain">
                          <a href="../logout.php">Logout</a>
                        </li>
                      <?php else : ?>
                        <li class="product-box-contain">
                          <i></i>
                          <a href="login.php">Log In</a>
                        </li>

                        <li class="product-box-contain">
                          <a href="sign-up.php">Register</a>
                        </li>
                      <?php endif; ?>

                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</header>
<!-- Header End -->