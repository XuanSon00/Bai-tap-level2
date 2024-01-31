<?php
require 'config.php';

//xóa khóa học
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql=" DELETE FROM courses
            WHERE course_id=$id";
    $query = mysqli_query($link,$sql);

    if($query){
        echo "<script>alert('Xóa thành công');</script>";
        header('location:../admin.php');
    } else {
        echo "<script>alert('Có lỗi khi xóa!!');</script>";
    }

    $sql_user_courses = "   DELETE FROM user_courses 
                            WHERE course_id = $id";
    $query_user_courses = mysqli_query($link, $sql_user_courses);
    if ($query_user_courses) {
        echo "Xóa thành công";
    } else {
        echo "Lỗi khi xóa";
    }
}


//xóa giảng viên
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql=" DELETE FROM teachers
            WHERE teacher_id=$id";
    $query = mysqli_query($link,$sql);


    if($query){
        echo "<script>alert('Xóa thành công');</script>";
        header('location:../admin.php');
    } else {
        echo "<script>alert('Có lỗi khi xóa!!');</script>";
    }
}

//xóa môn học cho giảng viên
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql=" DELETE FROM teach_subject
            WHERE teacher_id=$id";
    $query = mysqli_query($link,$sql);


    if($query){
        echo "<script>alert('Xóa thành công');</script>";
        header('location:../admin.php');
    } else {
        echo "<script>alert('Có lỗi khi xóa!!');</script>";
    }
}

?>