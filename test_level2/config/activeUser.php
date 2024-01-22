<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $userActive = $_POST['user_active'];

    // Cập nhật giá trị cột user_active trong bảng users
    $sql = "UPDATE users 
            SET user_active = '$userActive' 
            WHERE user_id = '$userId'";
    $result= mysqli_query($link, $sql);

    if ($result === TRUE) {
        echo "Update successful";
    } else {
        echo "Error updating record: " . $link->error;
    }
}

$link->close();
?>