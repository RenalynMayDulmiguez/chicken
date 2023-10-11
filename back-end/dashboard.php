<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Crispy Fried Chicken - Dashboard</title>
  <!-- Google font-->
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">

  <!-- Fontawesome css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/font-awesome.css">

  <!-- Linear Icon css -->
  <link rel="stylesheet" href="assets/css/linearicon.css">

  <!-- remixicon css -->
  <link rel="stylesheet" type="text/css" href="assets/css/remixicon.css">

  <!-- Data Table css -->
  <link rel="stylesheet" type="text/css" href="assets/css/datatables.css">

  <!-- Themify icon css-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">

  <!-- Feather icon css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/feather-icon.css">

  <!-- Plugins css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">

  <!-- Bootstrap css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/bootstrap.css">

  <!-- App css -->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <style>
  
    .c-dashboardInfo {
  margin-bottom: 15px;
}
.c-dashboardInfo .wrap {
  background: #ffffff;
  box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
  border-radius: 7px;
  text-align: center;
  position: relative;
  overflow: hidden;
  padding: 40px 25px 20px;
  height: 100%;
}
.c-dashboardInfo__title,
.c-dashboardInfo__subInfo {
  color: #6c6c6c;
  font-size: 1.18em;
}
.c-dashboardInfo span {
  display: block;
}
.c-dashboardInfo__count {
  font-weight: 600;
  font-size: 2.5em;
  line-height: 64px;
  color: #323c43;
}
.c-dashboardInfo .wrap:after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 10px;
  content: "";
}

.c-dashboardInfo:nth-child(1) .wrap:after {
  background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
}
.c-dashboardInfo:nth-child(2) .wrap:after {
  background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
}
.c-dashboardInfo:nth-child(3) .wrap:after {
  background: linear-gradient(69.83deg, #0084f4 0%, #00c48c 100%);
}
.c-dashboardInfo:nth-child(4) .wrap:after {
  background: linear-gradient(81.67deg, #ff647c 0%, #1f5dc5 100%);
}
.c-dashboardInfo:nth-child(5) .wrap:after {
  background: linear-gradient(81.67deg, skyblue 0%, pink 100%);
}
.c-dashboardInfo__title svg {
  color: #d7d7d7;
  margin-left: 5px;
}
.MuiSvgIcon-root-19 {
  fill: currentColor;
  width: 1em;
  height: 1em;
  display: inline-block;
  font-size: 24px;
  transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
  user-select: none;
  flex-shrink: 0;
}

  </style>
</head>

<body>
  <!-- tap on top start -->
  <div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
  </div>
  <!-- tap on tap end -->

  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include './shared/header.php'; ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start -->
    <div class="page-body-wrapper">
      <!-- Page Sidebar Start-->
      <?php include './shared/sidebar.php'; ?>
      <!-- Page Sidebar Ends-->

      <div style="margin-left:150px;">
  <div class="container pt-5">
    <div class="row align-items-stretch">
      <!-- Total Users -->
      <div class="c-dashboardInfo col-lg-3 col-md-6">
        <div class="wrap">
          <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
            <i class="fas fa-users"></i> Total Users
          </h4>
          <a href="all-users.php"><span class="hind-font caption-12 c-dashboardInfo__count">{{users.length}}</span></a>
        </div>
      </div>
      <!-- Total Products -->
      <div class="c-dashboardInfo col-lg-3 col-md-6">
        <div class="wrap">
          <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
            <i class="fas fa-truck"></i> Total Deliver
          </h4>
          <span class="hind-font caption-12 c-dashboardInfo__count">750</span>
        </div>
      </div>
         <div class="c-dashboardInfo col-lg-3 col-md-6">
        <div class="wrap">
          <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
            <i class="fas fa-cube"></i> Total Products
          </h4>
          <a href="products.php"><span class="hind-font caption-12 c-dashboardInfo__count">{{products.length}}</span></a>
        </div>
      </div>  
      <!-- Total Sales -->
      <div class="c-dashboardInfo col-lg-3 col-md-6">
        <div class="wrap">
          <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
            &#8369; Total Sales
          </h4>
          <span class="hind-font caption-12 c-dashboardInfo__count">&#8369;350,000</span>
        </div>
      </div>
      <!-- Total Pending -->
      <div class="c-dashboardInfo col-lg-3 col-md-6">
        <div class="wrap">
          <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
            <i class="fas fa-clock"></i> Total Pending
          </h4>
          <span class="hind-font caption-12 c-dashboardInfo__count">500</span>
        </div>
      </div>
    </div>
    <!-- Recent Orders Table with Product Names -->
 
    <div style="margin-left: 50px;">
  <div class="container pt-5">
    <div class="row align-items-stretch">
      <!-- Left Column: Products with Status -->
      <div class="col-lg-6">
        <h3 class="hind-font">Products with Status</h3>
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th>Product Name</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Crispy Fried Chicken</td>
              <td style="background-color: rgb(255, 0, 0); color:white;">Out of Stock</td>
            </tr>
            <tr>
              <td>Siomai</td>
              <td style="background-color: rgb(255, 255, 0);">Low on Stock</td>
            </tr>
            <tr>
              <td>Chicken Feet</td>
              <td style=" background-color: rgb(0, 255, 0);">In Stock</td>
            </tr>
            <!-- Add more products and their statuses here as needed -->
          </tbody>
        </table>
      </div>
      <!-- Right Column: Recent Orders -->
      <div class="col-lg-6">
        <h3 class="hind-font">Recent Orders</h3>
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th>Customer Name</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Orders</th>
              <th>Order Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Renalyn Dulmiguez</th>
              <td>Crispy Fried Chicken</td>
              <th>15</th>
              <td>300</td>
              <td>2023-10-07</td>
            </tr>
            <tr>
              <th>Rosell Mae  Manulat</th>
              <td>Siomai</td>
              <th>8</th>
              <td>200</td>
              <td>2023-10-06</td>
            </tr>
            <!-- Add more recent orders here as needed -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


    <!-- Page Body End -->

    <!-- Modal Start -->
    <?php   include './modals/deleteProductModal.php';
    include './modals/logoutModal.php'; ?>
    <!-- Modal End -->
  </div>



  <script src="../assets/js/axios.js"></script>
  <!-- vue js 3 -->
  <script src="../assets/js/vue.3.js"></script>

 
  <!-- latest js -->
  <script src="assets/js/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap js -->
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

  <!-- feather icon js -->
  <script src="assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather-icon.js"></script>

  <!-- scrollbar simplebar js -->
  <script src="assets/js/scrollbar/simplebar.js"></script>
  <script src="assets/js/scrollbar/custom.js"></script>

  <!-- customizer js -->
  <!-- <script src="assets/js/customizer.js"></script> -->

  <!-- Plugins JS -->
  <!-- <script src="assets/js/notify/bootstrap-notify.min.js"></script> -->
  <script src="assets/js/notify/index.js"></script>

  <!-- Data table js -->
  <script src="assets/js/jquery.dataTables.js"></script>
  <script src="assets/js/custom-data-table.js"></script>

  <!-- all checkbox select js -->
  <script src="assets/js/checkbox-all-check.js"></script>

  <!-- Theme js -->
  <script src="assets/js/script.js"></script>

   <!-- dashboard-vue-functions -->
   <script src="../src/admin/dashboard.js"></script>

   <!-- sidebar effect -->
  <script src="assets/js/sidebareffect.js"></script>

  <script src="assets/js/sidebar-menu.js"></script>
</body>

</html>