    <div class="sidebar-wrapper">
      <div id="sidebarEffect"></div>
      <div>
        <div class="logo-wrapper logo-wrapper-center">
          <a href="#" class="text-center">
            <img class="img-fluid for-white"
              src="../assets/images/friedlogo1.jpg"
              style="width: 50px; height:50px;" alt="logo" />
          </a>
          <div class="back-btn">
            <i class="fa fa-angle-left"></i>
          </div>

        </div>

        <nav class="sidebar-main">
          <div class="left-arrow" id="left-arrow">
            <i data-feather="arrow-left"></i>
          </div>

          <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
              <li class="back-btn"></li>

              <li class="sidebar-list">
                <a class="linear-icon-link sidebar-link sidebar-title"
                  href="javascript:void(0)">
                  <i class="ri-store-3-line"></i>
                  <span>Product</span>
                </a>
                <ul class="sidebar-submenu">
                  <li>
                    <a href="products.php">Products</a>
                  </li>

                  <li>
                    <a href="add-new-product.php">Add New Products</a>
                  </li>
                </ul>
              </li>

              <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="all-users.php">
                  <i class="ri-user-3-line"></i>
                  <span>Users</span>
                </a>
              </li>

              <li class="sidebar-list">
                <a class="sidebar-link sidebar-title text-white"
                 data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
              </li>
            </ul>
          </div>

          <div class="right-arrow" id="right-arrow">
            <i data-feather="arrow-right"></i>
          </div>
        </nav>
      </div>
    </div>

    <div class="container-fluid">
          <!-- footer start-->
          <?php 
            include './modals/logoutModal.php'; ?>
        </div>