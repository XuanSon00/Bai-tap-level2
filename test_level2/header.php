<?php
session_start();
require 'config/config.php'
?>
<!--------------------jquery------------------------------------->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--------------------Bootstrap5------------------------------------->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!--------------------DataTable------------------------------------->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<!--------------------Font Awesome------------------------------------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /><!--------------------Jquery------------------------------------->
<!--------------------Material Design Iconic------------------------------------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<!--------------------SweetAlert2------------------------------------->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--------------------CSS FILE------------------------------------->
<link rel="stylesheet" href="css/header.css">
<!--------------------------------------------------------->

<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <div class="container-fluid" style="padding: 0">
    <a class="navbar-brand" href="#"><img src="img/a.png" alt="" style='width: 100px'></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
        <li class="nav-item <?php if($page=='home'){echo 'current';} ?>">
          <a class="nav-link " aria-current="page" href="index.php">Trang chủ</a>
        </li>
        <li class="nav-item <?php if($page=='introduce'){echo 'current';} ?>">
          <a class="nav-link " aria-current="page" href="introduce.php">Giới thiệu</a>
        </li>
        <li class="nav-item <?php if($page=='course'){echo 'current';} ?>">
          <a class="nav-link" href="course.php">Khóa học</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Liên hệ</a>
        </li>
      </ul>
      <div class="d-flex" style="padding: 10px 50px 0 0;">
      <!--<input class="form-control me-2 search" type="search" placeholder="Tìm kiếm..." aria-label="Search" >
      <button class="searchBtn"  type="submit" style ='background-color:#e91e63; width:50px '><i class='fa fa-search'></i></button>-->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <?php
      if (isset($_SESSION['login']) && $_SESSION['login'] === true  ) {
        $sql= "SELECT * FROM users WHERE user_id = ". $_SESSION['user_id'];
                  $result = mysqli_query($link,$sql);
                  if(mysqli_num_rows($result) >0){
                    $row = mysqli_fetch_assoc($result);
                    $username = $row['username'];
                    $user_birthday = $row['user_birthday'];
                    $user_email = $row['user_email'];
                    $user_active = $row['user_active'];
                    $user_id = $row['user_id'];
                    $user_role = $row['user_role'];

        echo "
          <li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
            <img src='img/gamer.png' alt='Avatar' style='width: 30px; height: 30px;'>
            Xin chào " . $username . "
          </a>
          <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
            <li><a class='dropdown-item' href='" . ($user_role == 0 ? 'admin.php' : 'user.php?id=' . $user_id) . "'>Thông tin cá nhân</a></li>
            <li><a class='dropdown-item' href='logout.php'>Đăng xuất</a></li>
          </ul>
        </li>";
    } else {
      //var_dump(123);
      //die();
        echo "<li class='nav-item'>
                <a class='nav-link " . ($page=='register'? 'current' : '') . "' href='register.php'>Đăng ký</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link " . ($page=='login'? 'current' : '') . "' href='login.php'>Đăng nhập</a>
              </li>";
    }
    }?>
      </ul>
  </div>
    </div>
  </div>
</nav>