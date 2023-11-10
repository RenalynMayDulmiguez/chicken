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

  <title>Crispy Fried Chicken - All User</title>
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
</head>

<body>
  <div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
  </div>

  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <?php include './shared/header.php'; ?>

    <div class="page-body-wrapper">
      <?php include './shared/sidebar.php'; ?>

      <div class="page-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
                <div class="card-body">
                  <div class="title-header option-title">
                    <h5>All Users</h5>
                  </div>

                  <div class="table-responsive table-product">
                    <table class="table all-package theme-table" id="table_id">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Created</th>
                          <th>Updated</th>
                          <th>Role</th>
                          <th>Option</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr v-for="user in users">
                          <td>
                            <div class="user-name">
                              <span>{{user.fullname}}</span>
                            </div>
                          </td>

                          <td>{{user.mobile}}</td>

                          <td>{{user.email}}</td>

                          <td>{{user.created_at}}</td>
                          <td>{{user.updated_at}}</td>
                          <td>{{ user.role === 0 ? 'user' : (user.role === 1 ? 'admin' : user.role) }}</td>
                          <td>
                            <ul>
                              <a class="me-2" @click="editUser(user)" data-bs-toggle="modal" data-bs-target="#editUser">
                                <i class="fas fa-edit" style="color: green;"></i>
                              </a>

                              <a class="me-2" @click="deleteUser(user.id)" id="delete" data-bs-toggle="modal" data-bs-target="#deleteUser">
                                <i data-feather="trash" style="color: red;"></i>
                              </a>
                              <li>
                                <a href="javascript:void(0)" @click="updateCounterlock(user.id, user.counterlock)">
                                  <div v-if="user.counterlock >= 3" class="d-flex align-items-center">
                                    <i class="text-danger me-2" data-feather="unlock"> </i>
                                    Unlock account
                                  </div>
                                  <i v-else data-feather="lock"></i>
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

        <div class="container-fluid">
          <?php include './shared/footer.php'; ?>
        </div>
      </div>
    </div>

    <?php include './modals/deleteProductModal.php';
    include './modals/logoutModal.php'; ?>
  </div>
  <script src="../assets/js/axios.js"></script>
  <script src="../assets/js/vue.3.js"></script>
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
  <script src="../src/admin/user.js"></script>
  <script src="assets/js/sidebareffect.js"></script>
  <script src="assets/js/sidebar-menu.js"></script>
</body>

</html>