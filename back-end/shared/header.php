<?php 
  session_start();

  if(!isset($_SESSION['id']) || $_SESSION['user']['role'] == 0) {
    header('location: ../front-end/index.php');
  }
  ?>
<div class="page-header">
  <div class="header-wrapper m-0">
    <div class="header-logo-wrapper p-0">
      <div class="logo-wrapper">
        <a href="index.php">
          <img class="img-fluid main-logo" src="assets/images/logo/1.png" alt="logo" />
          <img class="img-fluid white-logo" src="assets/images/logo/1-white.png" alt="logo" />
        </a>
      </div>
      <div class="toggle-sidebar">
        <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
        <a href="index.php">
          <img src="assets/images/logo/1.png" class="img-fluid" alt="" />
        </a>
      </div>
    </div>

    <div class="nav-right col-6 pull-right right-header p-0">
      <ul class="nav-menus">
        <li>
          <span class="header-search">
            <i class="ri-search-line"></i>
          </span>
        </li>

        <!-- <li class="profile-nav onhover-dropdown pe-0 me-0">
          <div class="media profile-media">
            <div class="user-name-hide media-body">
              <span>
                <?= 
                $_SESSION['user']['fullname']; 
                ?>
              </span>
              <p class="mb-0 font-roboto">
                <?php 
                if($_SESSION['user']['role'] == 1)
                {
                  echo 'Admin';
                } 
         
                ?>
                <i class="middle ri-arrow-down-s-line"></i>
              </p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li>
              <a href="../logout.php">
                <i data-feather="log-out"></i>
                <span>Log out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul> -->
    </div>
  </div>
</div>
