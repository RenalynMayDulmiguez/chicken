<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();

// if (!isset($_SESSION['id']) || $_SESSION['role'] == 0) {
//   header('location: ../front-end/index.php');
// }
?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  < <title>Product</title>

    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css" />
    <link rel="stylesheet" href="assets/css/linearicon.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/remixicon.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/datatables.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
  <div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
  </div>

  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <?php include './shared/header.php'; ?>

    <div class="page-body-wrapper" id="app">
      <?php include './shared/sidebar.php'; ?>

      <div class="page-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
                <div class="card-body">
                  <div class="title-header option-title d-sm-flex d-block">
                    <h5>History Transaction List</h5>
                    <h5><a href="transaction.php" class="text-primary">Transaction</a></h5>
                  </div>
                  <div>
                    <div class="table-responsive">
                      <table class="table all-package theme-table table-product" id="table_id">
                        <thead>
                          <tr>
                            <th cols="5%">#</th>
                            <th cols="5%">Product</th>
                            <th cols="5%">Buyer Name</th>
                            <th cols="5%">Total Amount</th>
                            <th cols="5%">Address</th>
                            <th cols="5%">Payment Method</th>
                            <th cols="5%">Delivery Status</th>
                            <th cols="5%">Proof of payment</th>
                            <th cols="5%">Mobile Number</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr v-for="(t, index) in HistoryTransactions">
                            <td>{{1+index++}}</td>
                            <td>
                              <div class="table-image">
                                <img :src="`../uploads/products/${t.images}`" class="img-fluid" :alt="product.mainImage" />
                              </div>
                              {{t.productName}}
                            </td>
                            <td class="td-price text-capitalize">{{ t.fullname }}</td>
                            <td class="td-price text-capitalize">₱{{ t.transaction_amount }}</td>
                            <td class="td-price text-capitalize">{{ t.address }}</td>
                            <td class="td-price text-capitalize">{{ t.paymentMethod }}</td>
                            <td class="td-price text-capitalize">{{ t.deliver_status == 0 ? 'Waiting for Approval' : t.deliver_status == 1 ? 'Approved': t.deliver_status == 2 ? 'Decline' : 'Deliver' }}</td>
                            <td class="td-price"><img :src="t.proofOfQRcode" class="img-fluid d-block" width="100" :alt="product.mainImage" /></td>
                            <td class="td-price text-capitalize">{{ t.mobile }}</td>
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

        <div class="container-fluid">
          <?php
          include './shared/footer.php'; ?>
        </div>
      </div>
    </div>
  </div>



  <script src="../assets/js/axios.js"></script>
  <script src="../assets/js/vue.3.js"></script>
  <script src="../src/product.js"></script>
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
  <script src="assets/js/scrollbar/simplebar.js"></script>
  <script src="assets/js/scrollbar/custom.js"></script>
  <script src="assets/js/config.js"></script>
  <script src="assets/js/sidebar-menu.js"></script>
  <script src="assets/js/notify/index.js"></script>
  <script src="assets/js/jquery.dataTables.js"></script>
  <script src="assets/js/custom-data-table.js"></script>
  <script src="assets/js/sidebareffect.js"></script>
  <script src="assets/js/script.js"></script>
</body>

</html>