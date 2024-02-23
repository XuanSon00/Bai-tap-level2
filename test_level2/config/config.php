<?php 
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'php_level2';
$link = mysqli_connect($servername, $username, $password, $dbname);


    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }    
  
//$link->close();

?>