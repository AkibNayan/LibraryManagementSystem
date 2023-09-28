<?php
  
  ob_start();
  session_start();
  include "admin/inc/db.php";

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Aweosome CDN link -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <!-- jQuery UI datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/style.css">

    <title>Library Management</title>
  </head>
  <body>
    
    <header>
      <div class="container">
        <!-- Nav bar section start -->
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
              <img src="admin/dist/img/logo/logo.png" width="120">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#book-section">Books</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link active" aria-current="page" href="#contact-info">Contact</a>
                </li>
                <li class="nav-item dropdown">

                  <?php

                    if (!empty($_SESSION['user_id'])) {

                      $user_id = $_SESSION['user_id'];

                      $sql = "SELECT * FROM users WHERE user_id  = '$user_id' ";
                      $result = mysqli_query($db, $sql);
                      while ($row = mysqli_fetch_assoc($result)) {
                        $fullname   = $row['fullname'];
                        $image      = $row['image'];
                        $role       = $row['role'];
                      }
                      ?>

                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php 
                          if (!empty($image)) {
                            ?>
                            <img src="admin/dist/img/users/<?php echo $image; ?>" class="userImg">
                            <?php
                          }
                          else {
                            ?>
                            <img src="admin/dist/img/user8-128x128.jpg" class="userImg">
                            <?php
                          }
                          
                          echo $fullname; ?></a>

                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php

                          if ($role == 1) {
                            ?>
                            <li><a class="dropdown-item" href="admin/dashboard.php">Dashboard</a></li>
                            <?php
                          }

                        ?>  
                        <li><a class="dropdown-item" href="order-history.php?do=Manage">Booking Item List</a></li>  
                        <li><a class="dropdown-item" href="profile.php?login_id=<?php echo $user_id; ?>">Manage Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>  
                      </ul>

                      <?php

                    }
                    else {
                      ?>


                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                      </li>

                      <?php
                    }

                  ?>

                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- Nav bar section end -->
      </div>
    </header>