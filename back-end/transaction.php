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
                    <h5>Transaction List</h5>
                  </div>
                  <div>
                    <div class="table-responsive">
                      <table class="table all-package theme-table table-product" id="table_id">
                        <thead>
                          <tr>
                            <th>Product</th>
                            <th>Buyer Name</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Delivery Status</th>
                            <th>Proof of payment</th>
                            <th>Mobile Number</th>
                            <th>Change Status</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr v-for="t in transactions">
                            <td>
                              <div class="table-image">
                                <img :src="`../uploads/products/${t.images}`" class="img-fluid" :alt="product.mainImage" />
                              </div>
                              {{t.productName}}
                            </td>
                            <td class="td-price">{{ t.fullname }}</td>
                            <td class="td-price">₱{{ t.transaction_amount }}</td>
                            <td class="td-price">{{ t.paymentMethod }}</td>
                            <td class="td-price">{{ t.deliver_status == 0 ? 'Waiting for Approval' : 'Approved' }}</td>
                            <td class="td-price"><img :src="t.proofOfQRcode" class="img-fluid" :alt="product.mainImage" /></td>
                            <td class="td-price">{{ t.mobile }}</td>
                            <td class="d-flex justify-content-center my-2">
                              <button class="btn btn-sm btn-info col-12" data-bs-toggle="modal" data-bs-target="#updateTransaction" @click="selectTrans(t.trans_id)">Update</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="modal fade" id="updateTransaction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <select v-model="TransStatus" class="form-control">
                                <option value="selected">Select</option>
                                <option :value="selectedTransStatus == 0 ? '1' : '2'">{{selectedTransStatus == 0 ? 'Pending' : selectedTransStatus == 1 ? 'Approve' : 'Decline'}}</option>
                              </select>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" @click="updateStatusTransaction">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
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