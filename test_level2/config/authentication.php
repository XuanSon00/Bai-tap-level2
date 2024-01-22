<?php

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit;
}