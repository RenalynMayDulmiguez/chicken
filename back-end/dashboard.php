<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();

// if (!isset($_SESSION['id']) || $_SESSION['role'] == 0) {
//   header('location: ../front-end/index.php');
// }
?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Crispy Fried Chicken - Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">
  <link rel="stylesheet" href="assets/css/linearicon.css">
  <link rel="stylesheet" type="text/css" href="assets/css/remixicon.css">
  <link rel="stylesheet" type="text/css" href="assets/css/datatables.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
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
  <div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
  </div>

  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <?php include 'shared/header.php'; ?>

    <div class="page-body-wrapper">
      <?php include './shared/sidebar.php'; ?>

      <div class="page-body">
        <div class="container-fluid">
          <div class="row align-items-stretch">
            <div class="c-dashboardInfo col-lg-3 col-md-6">
              <div class="wrap">
                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                  <i class="fas fa-users"></i> Total Users
                </h4>
                <a href="all-users.php"><span class="hind-font caption-12 c-dashboardInfo__count">{{users.length}}</span></a>
              </div>
            </div>
            <div class="c-dashboardInfo col-lg-3 col-md-6">
              <div class="wrap">
                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                  <i class="fas fa-truck"></i> Total Deliver
                </h4>
                <span class="hind-font caption-12 c-dashboardInfo__count">{{delivercount}}</span>
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
            <div class="c-dashboardInfo col-lg-3 col-md-6">
              <div class="wrap">
                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                  &#8369; Total Sales
                </h4>
                <span class="hind-font caption-12 c-dashboardInfo__count">&#8369;{{paid}}</span>
              </div>
            </div>
            <div class="c-dashboardInfo col-lg-3 col-md-6">
              <div class="wrap">
                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                  <i class="fas fa-clock"></i> Total Pending
                </h4>
                <span class="hind-font caption-12 c-dashboardInfo__count">{{notpaid}}</span>
              </div>
            </div>
          </div>

          <div>
            <div class="container pt-5">
              <div class="row align-items-stretch">
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
                      <tr v-for="product in products">
                        <td>{{product.name}}</td>
                        <td style="background-color: rgb(255, 225, 225); color:black;">{{product.quantity}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
                      <tr v-for="ro of recentOrders">
                        <th>{{ro.fullname}}</th>
                        <td>{{ro.name}}</td>
                        <th>{{ro.price}}</th>
                        <td>{{ro.transaction_amount}}</td>
                        <td>{{ro.created_date}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include './modals/deleteProductModal.php';
  include './modals/logoutModal.php'; ?>
  </div>
  <script src="../assets/js/axios.js"></script>
  <script src="../assets/js/vue.3.js"></script>
  <script src="../src/admin/dashboard.js"></script>
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
  <script src="assets/js/scrollbar/simplebar.js"></script>
  <script src="assets/js/scrollbar/custom.js"></script>
  <script src="assets/js/notify/index.js"></script>
  <script src="assets/js/jquery.dataTables.js"></script>
  <script src="assets/js/custom-data-table.js"></script>
  <script src="assets/js/checkbox-all-check.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="assets/js/sidebareffect.js"></script>
  <script src="assets/js/sidebar-menu.js"></script>
</body>

</html>