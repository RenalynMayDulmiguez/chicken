<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Product</title>

    <!-- Google font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      rel="stylesheet"
    />

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="assets/css/linearicon.css" />

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css" />

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css" />

    <!--Dropzon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/dropzone.css" />

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css" />

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/remixicon.css" />

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css" />

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/chartist.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/date-picker.css" />

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css" />

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap-tagsinput.css" />

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  </head>

  <body>
    <!-- tap on top start -->
    <div class="tap-top">
      <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper start -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <?php include './shared/header.php'; ?>
      <!-- Page Header Ends-->

      <!-- Page Body start -->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include './shared/sidebar.php'; ?>
        <!-- Page Sidebar Ends-->

        <div class="page-body">
          <!-- New Product Add Start -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <div class="col-sm-8 m-auto">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-header-2">
                          <h5>Product Information</h5>
                        </div>

                        <form @submit="addProduct" class="theme-form theme-form-2 mega-form">
                          <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" required name="name" placeholder="Product Name" />
                            </div>
                          </div>

                          <div class="mb-4 row align-items-center">
                            <label class="col-sm-3 col-form-label form-label-title">Description</label>
                            <div class="col-sm-9">
                              <div class="bs-example">
                                <textarea class="form-control" required name="description"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="mb-4 row align-items-center">
                            <label class="col-sm-3 form-label-title">price</label>
                            <div class="col-sm-9">
                              <input
                                class="form-control"
                                type="number"
                                required
                                name="price"
                                step="0.01"
                                required
                                placeholder="₱99.99"
                              />
                            </div>
                          </div>

                          <div class="mb-4 row align-items-center">
                            <label class="col-sm-3 form-label-title">quantity</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="quantity" required type="number" placeholder="1" />
                            </div>
                          </div>

                          <div class="mb-4 row align-items-center">
                            <label class="col-sm-3 col-form-label form-label-title">Images</label>
                            <div class="col-sm-9">
                              <input
                                class="form-control form-choose"
                                name="products[]"
                                required
                                type="file"
                                id="formFile"
                                multiple
                              />
                            </div>
                          </div>
                          <div class="mb-4 row align-items-center">
                            <label class="col-sm-3 col-form-label form-label-title"></label>
                            <div class="col-sm-9">
                              <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- New Product Add End -->

          <!-- footer Start -->
          <?php include './shared/footer.php'; ?>
          <!-- footer En -->
        </div>
        <!-- Container-fluid End -->
      </div>
      <!-- Page Body End -->
    </div>
    <!-- page-wrapper End -->

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

    <!-- bootstrap tag-input js -->
    <script src="assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>
    <!--Dropzon js -->
    <script src="assets/js/dropzone/dropzone.js"></script>
    <script src="assets/js/dropzone/dropzone-script.js"></script>

    <!-- Plugins js -->
    <!-- <script src="assets/js/notify/bootstrap-notify.min.js"></script> -->
    <script src="assets/js/notify/index.js"></script>

    <!-- ck editor js -->
    <script src="assets/js/ckeditor.js"></script>
    <script src="assets/js/ckeditor-custom.js"></script>

    <!-- select2 js -->
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/select2-custom.js"></script>

    <!-- sidebar effect -->
    <script src="assets/js/sidebareffect.js"></script>

    <!-- Theme js -->
    <script src="assets/js/script.js"></script>
    <!-- axios -->
    <script src="../assets/js/axios.js"></script>
    <script src="../assets/js/vue.3.js"></script>
    <script src="../src/add-product.js"></script>
  </body>
</html>
