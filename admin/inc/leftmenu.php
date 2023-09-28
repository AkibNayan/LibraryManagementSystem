 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      Library <span>Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <?php

          $adminId = $_SESSION['user_id'];

          $sql = "SELECT * FROM users WHERE user_id = '$adminId' ";
          $result = mysqli_query($db, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            $fullname = $row['fullname'];
            $image    = $row['image'];
            
            if (!empty($image)) {
              ?>
              <div class="image">
                <img src="dist/img/users/<?php echo $image;?>" class="img-circle elevation-2" alt="User Image">
              </div>
              <?php
            }
            else {
              ?>
              <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <?php
            }

            ?>

            <div class="info">
              <a href="#" class="d-block"><?php echo $fullname; ?></a>
            </div>

            <?php
          }

        ?>
        
        
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          <li class="nav-header">Library Management</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Category Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="category.php?do=Create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Category</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Books Management Start -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Books Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="books.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Books</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="books.php?do=Create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Book</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Books Management End -->
          <!-- Order Management Start -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-shopping-cart"></i>
              <p>
                Order Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="order-details.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Order Management End -->
          <!-- Users Management -->
          <li class="nav-header">Users Management</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="users.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="users.php?do=Create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>