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