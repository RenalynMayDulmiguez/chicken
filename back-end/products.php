<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <
  <title>Product</title>

  <!-- Google font-->
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet" />

  <!-- Fontawesome css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/font-awesome.css" />

  <!-- Linear Icon css -->
  <link rel="stylesheet" href="assets/css/linearicon.css" />

  <!-- Themify icon css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/themify.css" />

  <!-- Feather icon css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/feather-icon.css" />

  <!-- remixicon css -->
  <link rel="stylesheet" type="text/css" href="assets/css/remixicon.css" />

  <!-- Data Table css -->
  <link rel="stylesheet" type="text/css" href="assets/css/datatables.css" />

  <!-- Plugins css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/scrollbar.css" />
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/animate.css" />

  <!-- Bootstrap css -->
  <link rel="stylesheet" type="text/css"
    href="assets/css/vendors/bootstrap.css" />

  <!-- App css -->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
  <!-- tap on top start-->
  <div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
  </div>
  <!-- tap on tap end-->

  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include './shared/header.php'; ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper" id="app">
      <!-- Page Sidebar Start-->
      <?php include './shared/sidebar.php'; ?>
      <!-- Page Sidebar Ends-->

      <!-- Container-fluid starts-->
      <div class="page-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
                <div class="card-body">
                  <div class="title-header option-title d-sm-flex d-block">
                    <h5>Products List</h5>
                    <div class="right-options">
                      <ul>
                        <li>
                          <a class="btn btn-solid"
                            href="add-new-product.php">Add Product</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div>
                    <div class="table-responsive">
                      <table class="table all-package theme-table table-product"
                        id="table_id">
                        <thead>
                          <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Current Qty</th>
                            <th>Price</th>
                            <th>Option</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr v-for="product in products">
                            <td>
                              <div class="table-image">
                                <img
                                  :src="`../uploads/products/${product.mainImage}`"
                                  class="img-fluid" :alt="product.mainImage" />
                              </div>
                            </td>

                            <td>{{ product.name }}</td>
                            <td>{{ product.quantity }}</td>

                            <td class="td-price">₱{{ product.price }}</td>

                            <td>
                              <ul>
                                          <li>
              <a href="javascript:void(0)" @click="editProduct(product)">
                <i class="ri-edit-line"></i>
              </a>
            </li>
                                <li>
                                  <a href="javascript:void(0)"
                                    @click="getProduct(product)">
                                    <i class="ri-delete-bin-line"></i>
                                  </a>
                                </li>
                              </ul>
                            </td>
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
        <!-- Container-fluid Ends-->

        <div class="container-fluid">
          <!-- footer start-->
          <?php 
            include './modals/deleteProductModal.php';
            include './shared/footer.php'; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- page-wrapper End-->



  <!-- axios -->
  <script src="../assets/js/axios.js"></script>
  <script src="../assets/js/vue.3.js"></script>
  <script src="../src/product.js"></script>

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

  <!-- Sidebar js -->
  <script src="assets/js/config.js"></script>

  <!-- Plugins js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- <script src="assets/js/notify/bootstrap-notify.min.js"></script> -->
  <script src="assets/js/notify/index.js"></script>

  <!-- Data table js -->
  <script src="assets/js/jquery.dataTables.js"></script>
  <script src="assets/js/custom-data-table.js"></script>

  <!-- sidebar effect -->
  <script src="assets/js/sidebareffect.js"></script>

  <!-- Theme js -->
  <script src="assets/js/script.js"></script>
</body>

</html>