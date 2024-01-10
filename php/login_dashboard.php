<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login';
$link = mysqli_connect($servername, $username, $password, $dbname);

if(!isset($_SESSION['USER_ID'])){
    header('location:login_form_cap.php');
    die();
}
?>

<h1><?php echo "Welcome " .$_SESSION['USER_ID'];?></h1>
<a href="login_logout.php">Logout</a>