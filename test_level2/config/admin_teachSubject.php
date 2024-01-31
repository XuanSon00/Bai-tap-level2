<?php 
require 'config.php';
//thêm môn học cho giảng viên
if(isset($_POST['submit'])){
    
    $teacher_id = mysqli_real_escape_string($link, $_POST['teacher_id']);
    $subject_id = mysqli_real_escape_string($link, $_POST['subject_id']);
    //$subject_des = mysqli_real_escape_string($link, $_POST['subject_des']);


    $sql = "INSERT INTO teach_subject(teacher_id, subject_id)
            VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $teacher_id, $subject_id);
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


