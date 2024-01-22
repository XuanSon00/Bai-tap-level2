<?php 
session_start();
$page='';?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <div class="container-fluid" style="padding: 0">
    <a class="navbar-brand" href="#"><img src="img/a.png" alt="" style='width: 100px'></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
        <li class="nav-item <?php if($page=='home'){echo 'active';} ?>">
          <a class="nav-link " aria-current="page" href="index.php">Trang chủ</a>
        </li>
        <li class="nav-item <?php if($page=='introduce'){echo 'active';} ?>">
          <a class="nav-link " aria-current="page" href="introduce.php">Giới thiệu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="course.php">Khóa học</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Liên hệ</a>
        </li>
      </ul>
      <form class="d-flex" style="padding: 10px 50px 0 0;">
      <!--<input class="form-control me-2 search" type="search" placeholder="Tìm kiếm..." aria-label="Search" >
      <button class="searchBtn"  type="submit" style ='background-color:#e91e63; width:50px '><i class='fa fa-search'></i></button>-->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <?php
      if (isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['username']) ) {
        echo "
          <li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
            <img src='img/gamer.png' alt='Avatar' style='width: 30px; height: 30px;'>
            Xin chào " . $_SESSION['username'] . "
          </a>
          <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
            <li><a class='dropdown-item' href='" . ($_SESSION['user_role'] == 0 ? 'admin.php' : 'user.php?id=' . $_SESSION['id']) . "'>Thông tin cá nhân</a></li>
            <li><a class='dropdown-item' href='logout.php'>Đăng xuất</a></li>
          </ul>
        </li>";
    } else {
        echo "<li class='nav-item'>
                <a class='nav-link " . ($page=='register'? 'active' : '') . "' href='register.php'>Đăng ký</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link " . ($page=='login'? 'active' : '') . "' href='login.php'>Đăng nhập</a>
              </li>";
    }?>
      </ul>
      </form>
    </div>
  </div>
</nav>