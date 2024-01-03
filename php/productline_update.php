<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'classicmodels';
$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save'])) {
    $productLine = $_POST['productLine_edit'];
    $textDescription = $_POST['textDescription_edit'];
    $htmlDescription = $_POST['htmlDescription_edit'];

    $updateQuery = "UPDATE productlines 
    SET textDescription=?, 
        htmlDescription=? 
    WHERE productLine=?";

    $stmt = mysqli_prepare($link, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'sss', $textDescription, $htmlDescription, $productLine);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Cập nhật thành công.";
        echo "<script>window.location.href='productline.php';</script>";
    } else {
        echo "Lỗi khi cập nhật: " . mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
}

$link->close();
?>