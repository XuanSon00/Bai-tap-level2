<?php 
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test_level_2';
$link = mysqli_connect($servername, $username, $password, $dbname);


    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }    
  
//$link->close();

?>