<?php
require('config.php');

if (isset($_GET['Id']) && isset($_GET['course_status'])) {
    $id = $_GET['Id'];
    $status = $_GET['course_status'];

    $query = "  UPDATE courses 
                SET course_status = $status 
                WHERE course_id = $id";
    $result = mysqli_query($link, $query);
    header('location:../admin.php');

    if ($result && mysqli_affected_rows($link) > 0) {
        echo "Cập nhật trạng thái thành công.";
    } else {
        echo "Cập nhật trạng thái thất bại.";
    }
} else {
    echo "Không hợp lệ.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST['user_id'];
    $confirm=$_POST['confirmation_button'];
        $sql="  UPDATE users
                SET user_active = 0
                WHERE user_id = '$user_id'";
        $result=mysqli_query($link,$sql);
        if($result === TRUE){
            echo 'cập nhật thành công';
        } else{
            echo 'có lỗi trong quá trình cập nhật';
        }
    } else{
        echo 'lỗi hệ thống ';
}

mysqli_close($link);
?>