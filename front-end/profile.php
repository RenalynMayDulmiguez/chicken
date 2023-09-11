<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
$sessionData = isset($_SESSION['user']) ? $_SESSION['user'] : [];
$username = isset($sessionData['username']) ? $sessionData['username'] : '';
$fullname = isset($sessionData['fullname']) ? $sessionData['fullname'] : '';
$address = isset($sessionData['address']) ? $sessionData['address'] : '';
$email = isset($sessionData['email']) ? $sessionData['email'] : '';
$mobile = isset($sessionData['mobile']) ? $sessionData['mobile'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fried Chicken</title>

<!-- Google font -->
<link rel="preconnect" href="https://fonts.gstatic.com/">
  <link
    href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- bootstrap css -->
  <link id="rtl-link" rel="stylesheet" type="text/css"
    href="../assets/css/vendors/bootstrap.css">

  <!-- wow css -->
  <link rel="stylesheet" href="../assets/css/animate.min.css" />

  <!-- feather icon css -->
  <link rel="stylesheet" type="text/css"
    href="../assets/css/vendors/feather-icon.css">

  <!-- slick css -->
  <link rel="stylesheet" type="text/css"
    href="../assets/css/vendors/slick/slick.css">
  <link rel="stylesheet" type="text/css"
    href="../assets/css/vendors/slick/slick-theme.css">

  <!-- Iconly css -->
  <link rel="stylesheet" type="text/css" href="../assets/css/bulk-style.css">

  <!-- Template css -->
  <link id="color-link" rel="stylesheet" type="text/css"
    href="../assets/css/style.css">

</head>
<style>

    .password-toggle {
    position: absolute;
    right: 20px;
    top: 20px;
    width: 30px;
    cursor: pointer;
    font-size: 20px;
    color: #000;
  }
  .password-toggle-container {
    position: relative;
    display: flex;
  }
  h2{
    font-size:20px;
    color:black;
    background:orange;
  }
</style>

<body class="theme-color-1">
<?php 

include './shared/loader.php';
?>
<div>

<header class="pb-md-4 pb-0">
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

  <div class="top-nav top-header sticky-header">
    <div class="container-fluid-lg">
      <div class="row">
        <div class="col-12">
          <div class="navbar-top">
            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button"
              type="button" data-bs-toggle="offcanvas"
              data-bs-target="#primaryMenu">
              <span class="navbar-toggler-icon">
                <i data-feather="menu"></i>
              </span>
            </button>
            <a href="index.php" class="web-logo nav-logo">
              <img src="../assets/images/friedlogo.jpg"
                class="img-fluid lazyload" alt="" />
            </a>

            <div class="rightside-box">
              <ul class="right-side-menu">
                
                <?php if(isset($_SESSION['id'])) : ?>
                  <li class="right-side d-block">
                  <!-- <a href="favorites.php"
                    class="btn p-0 position-relative header-wishlist">
                    <i data-feather="heart"></i>
                    
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge">
                        {{ isFavoritesPage ? favorite.length : products.length }}
                        {{ products.length}}
                        <span class="visually-hidden">unread messages</span>
                      </span>
                  </a> -->
                </li>

                <li class="right-side">
                  <div class="onhover-dropdown header-badge">
                    <!-- <button type="button"
                      class="btn p-0 position-relative header-wishlist">
                      <i data-feather="shopping-cart"></i>
                      <span
                        class="position-absolute top-0 start-100 translate-middle badge">
                        {{ carts.length}}
                        <span class="visually-hidden">unread messages</span>
                      </span> -->
                    </button>

                    <div class="onhover-div">
                      <ul class="cart-list">
                        <li v-for="cart, i in carts"
                          class="product-box-contain">
                          <div class="drop-cart">
                            <a :href="`product.php?product_id=${cart.product_id}`"
                              class="drop-image">
                              <img
                                :src="`../uploads/products/${cart.mainImage}`"
                                class="lazyload" :alt="cart.mainImage" />
                            </a>

                            <div class="drop-contain">
                              <a href="product-left-thumbnail.html">
                                <h5 class="text-capitalize">{{ cart.name }}</h5>
                              </a>
                              <h6>
                                <span>{{ cart.quantity }} x</span>
                                ₱ {{ cart.price }}
                              </h6>
                              <button class="close-button close_button"
                                @click="removeCart(cart.id)">
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

                      <div class="button-group">
                        <a href="cart.php" class="btn btn-sm cart-button">View
                          Cart</a>
                        <a href="#!"
                          class="btn btn-sm cart-button theme-bg-color text-white">Checkout</a>
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
                      <h6>Hello,</h6>
                      <h5><?=  isset($_SESSION['id']) ?  $_SESSION['user']['fullname']  : '' ?></h5>
                    </div>
                  </div>

                  <div class="onhover-div onhover-div-login ">
                    <ul class="user-box-name">

                      <?php if(isset($_SESSION['id']) &&  $_SESSION['id']): ?>
                        <li class="product-box-contain">
                        <a href="../front-end/profile.php">Profile</a>
                      </li>
                      <li class="product-box-contain">
                        <a href="../logout.php">Logout</a>
                      </li>
                      <?php else: ?>
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

  <div class="container-fluid-lg">
    <div class="row">
      <div class="col-12">
        <div class="header-nav">
          <div class="header-nav-middle">
            <div
              class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
              <div class="offcanvas offcanvas-collapse order-xl-2"
                id="primaryMenu">
                <div class="offcanvas-header navbar-shadow">
                  <h5>Menu</h5>
                  <button class="btn-close lead" type="button"
                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="index.php">Home</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Header End -->


<div class="container" id="profile-app">
    <div class="col-md-6">
        <h3 class="text-dark" style="font-size: 35px;">PROFILE</h3>
        <form class="h2">
            <h2 class="form-control mb-4 bg-warning" >Username:
                {{username}}</h2>
            <h2 class="form-control mb-4 bg-warning">Fullname:
                {{fullname}}</h2>
            <h2 class="form-control mb-4 bg-warning" >Address:
                {{address}}</h2>
            <h2 class="form-control mb-4 bg-warning" >Mobile:
                {{mobile}}</h2>
            <h2 class="form-control mb-4 bg-warning">Email:
                {{email}}</h2>
            <a class="btn btn-success float-end mt-3 p-4 pt-4" data-bs-toggle="modal" data-bs-target="#editProfileModal" style="background: blue; color: white;">Edit</a>
            <a class="btn btn-warning float-end mt-3 me-2 p-4 pt-4" data-bs-toggle="modal" data-bs-target="#changePasswordModal" style="background: green; color: white;">Change Password</a>
        </form>
    </div>
</div>
            </div>

            </div>
<!-- Edit Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="editDetails($event)">
                    <div class="form-group">
                        <label for="username" style="font-size: 20px;">Username</label>
                        <input type="text" class="form-control" id="username" name="username" v-model="username">
                    </div>
                    <div class="form-group">
                        <label for="fullname" style="font-size: 20px;">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" v-model="fullname">
                    </div>
                    <div class="form-group">
                        <label for="address" style="font-size: 20px;">Address</label>
                        <input type="text" class="form-control" id="address" name="address" v-model="address">
                    </div>
                    <div class="form-group">
                        <label for="mobile" style="font-size: 20px;">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" v-model="mobile">
                    </div>
                    <div class="form-group">
                        <label for="email" style="font-size: 20px;">Email</label>
                        <input type="text" class="form-control" id="email" name="email" v-model="email">
                    </div>
                    <button type="submit" class="btn btn-primary" style="font-size:20px; background:green;">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>



        <!-- Change Password Modal ----->
        <div class="modal fade" id="changePasswordModal" tabindex="-1"
            aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="app">
                        <form @submit.prevent="changePassword($event)">
                        <div class="mb-3">
                            <label for="current-password" class="form-label" style="font-size: 20px; font-family: emoji;">Current Password</label>
                            <div class="password-toggle-container">
                                <input type="password" id="current-password" class="form-control" style="font-size: 20px; font-family: emoji;" v-model="currentPassword" required>
                                <i class="password-toggle fa fa-lock bg-light" id="toggleCurrentPassword"></i>
                            </div>
                            </div>

                            <div class="mb-3">
                            <label for="new-password" class="form-label" style="font-size: 20px; font-family: emoji;">New Password</label>
                            <div class="password-toggle-container">
                                <input type="password" id="new-password" class="form-control" style="font-size: 20px; font-family: emoji;" v-model="newPassword" required>
                                <i class="password-toggle fa fa-lock bg-light" id="toggleNewPassword"></i>
                            </div>
                            </div>

                            <div class="mb-3">
                            <label for="confirm-password" class="form-label" style="font-size: 20px; font-family: emoji;">Confirm Password</label>
                            <div class="password-toggle-container">
                                <input type="password" id="confirm-password" class="form-control" style="font-size: 20px; font-family: emoji;" v-model="confirmPassword" required>
                                <i class="password-toggle fa fa-lock bg-light" id="toggleConfirmPassword"></i>
                            </div>
                            </div>
                        <div class="text-center">
                                <button type="submit" class="btn btn-primary"
                                    style="font-size:20px; font-family:emoji; background:skyblue;">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

       <!-- custom js file  -->
       <?php include './shared/scripts.php'; ?>
       <script src="../src/user.js"></script>

       <script>
   const app = Vue.createApp({
  data() {
    return {
      username: '<?= $username ?>',
      fullname: '<?= $fullname ?>',
      address: '<?= $address ?>',
      mobile: '<?= $mobile ?>',
      email: '<?= $email ?>',
    };
  },
  methods: {
    async editDetails(e) {
      try {
        const formData = new FormData();
        formData.append('method', 'fnUpdate');
        formData.append('username', this.username);
        formData.append('fullname', this.fullname);
        formData.append('address', this.address);
        formData.append('mobile', this.mobile);
        formData.append('email', this.email);

        const response = await axios.post('../api/user-api.php', formData);

        if (response.data === 1) {
          alert('Your Personal Information Has Been Updated');
          window.location.reload();
        } else {
          alert('There was an error updating your user!');
          console.log(response.data); // Display the error message from the server
        }
      } catch (error) {
        console.error(error);
        alert('An error occurred while updating your user.');
      }
    },
  },
});

app.mount('#profile-app'); // Make sure to mount your Vue app to an element with id "app"

      </script>
<<script>
                                const toggleCurrentPassword = document.querySelector("#toggleCurrentPassword");
                                const toggleNewPassword = document.querySelector("#toggleNewPassword");
                                const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
                                const currentPassword = document.querySelector("#current-password");
                                const newPassword = document.querySelector("#new-password");
                                const confirmPassword = document.querySelector("#confirm-password");

                                toggleCurrentPassword.addEventListener("click", function () {
                                    const type = currentPassword.getAttribute("type") === "password" ? "text" : "password";
                                    currentPassword.setAttribute("type", type);
                                    this.classList.toggle("fa-lock");
                                    this.classList.toggle("fa-unlock");
                                });

                                toggleNewPassword.addEventListener("click", function () {
                                    const type = newPassword.getAttribute("type") === "password" ? "text" : "password";
                                    newPassword.setAttribute("type", type);
                                    this.classList.toggle("fa-lock");
                                    this.classList.toggle("fa-unlock");
                                });

                                toggleConfirmPassword.addEventListener("click", function () {
                                    const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
                                    confirmPassword.setAttribute("type", type);
                                    this.classList.toggle("fa-lock");
                                    this.classList.toggle("fa-unlock");
                                });
</script>
    </div>


</body>

</html>
