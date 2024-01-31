<?php 
require 'config.php';
//thêm giảng viên
if(isset($_POST['submit'])){
    $teacher_name = mysqli_real_escape_string($link, $_POST['teacher_name']);
    $teacher_email = mysqli_real_escape_string($link, $_POST['teacher_email']);
    $teacher_birthday = $_POST['teacher_date'];
    $create_at = date('d-m-Y H:i:s');

    $sql = "INSERT INTO teachers(teacher_name, teacher_email, teacher_birthday, created_at)
            VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $teacher_name, $teacher_email, $teacher_birthday);
        $executeResult = mysqli_stmt_execute($stmt);

        if ($executeResult) {
            echo "<script>
                alert('Thêm giảng viên thành công');
                window.location.href = '../admin.php'; 
            </script>";
        } else {
            echo "<script>alert('Thêm giảng viên không thành công');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Lỗi hệ thống');</script>";
    }
}

//thêm môn học cho giảng viên
if(isset($_POST['submit'])){
    $teacher_name = mysqli_real_escape_string($link, $_POST['teacher_name']);
    $teacher_id = mysqli_real_escape_string($link, $_POST['teacher_id']);
    $subject_name = mysqli_real_escape_string($link, $_POST['subject_name']);
    $subject_id = mysqli_real_escape_string($link, $_POST['subject_id']);
    $subject_des = mysqli_real_escape_string($link, $_POST['subject_des']);

    $sql = "INSERT INTO teach_subject(teacher_name, teacher_id, subject_id, subject_name, subject_des)
            VALUES (?, ?, ?, ?,?)";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $teacher_name, $teacher_id, $subject_name, $subject_id, $subject_des);
        $executeResult = mysqli_stmt_execute($stmt);

        if ($executeResult) {
            echo "<script>
                alert('Thêm môn học cho giảng viên thành công');
                window.location.href = '../admin.php'; 
            </script>";
        } else {
            echo "<script>alert('Thêm môn học cho giảng viên không thành công');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Lỗi hệ thống');</script>";
    }
}
?>


