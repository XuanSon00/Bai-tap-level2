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

mysqli_close($link);
?>