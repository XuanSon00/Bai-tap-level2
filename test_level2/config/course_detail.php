<?php 
session_start();

require('config.php');
//Học sinh Đăng ký khóa học
if (isset($_POST['user_course_submit'])) {
    // Lấy thông tin khóa học từ form
    $course_id = $_POST['course_id'];
    $course_subject = $_POST['course_subject'];
    $course_name = $_POST['course_name'];
    $course_class = $_POST['course_class'];
    $course_teacher = $_POST['course_teacher'];
    $create_at = date('d-m-Y H:i:s');

    // Lấy thông tin người dùng từ session
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $username = $_SESSION['username'];
    $user_active = $_SESSION['user_active'];

    // Kiểm tra xem người dùng đã đăng ký khóa học hay chưa
    $check_query = "    SELECT * 
                        FROM user_courses 
                        WHERE user_id = '$user_id' 
                        AND course_id = '$course_id'";
    $result = $link->query($check_query);


    if ($result->num_rows > 0) { // kiểm tra đã đăng ký khóa học chưa
        echo "<script>alert('Bạn đã đăng ký khóa học này rồi.');</script>";
        echo "<script>window.location.href = '../course.php';</script>";
    } elseif ($user_active != 0) { // kiểm tra xem người dùng đã được admin kích hoạt tài chưa
        // Thực hiện INSERT vào bảng user_course
        $insert_query = "INSERT INTO user_courses (user_name, user_id, course_id, course_subject, course_name, course_class, course_teacher, created_at)
                         VALUES ('$user_name' ,'$user_id', '$course_id', '$course_subject', '$course_name', '$course_class', '$course_teacher', Now())";

        if ($link->query($insert_query) === TRUE) {
            echo "<script>alert('Đăng ký khóa học thành công');</script>";
            echo "<script>window.location.href = '../course.php';</script>";
        } else {
            echo "<script>alert('Đã có lỗi xảy ra khi đăng ký khóa học');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng liên hệ admin để kích hoạt khóa học');</script>";
    }
}





// Xóa môn học đăng ký

if(isset($_POST['delete_course'])) {
    $delete_id = $_POST['delete_id'];

    // Thực hiện truy vấn SQL để xóa môn học dựa trên ID
    $delete_query = "   DELETE FROM user_courses 
                        WHERE ID = $delete_id";
    $delete_result = mysqli_query($link,$delete_query);

    if($delete_result) {
        echo "<script>alert('Xóa môn học thành công');</script>";
        echo "<script>window.location.href = '../course.php';</script>";
    } else {
        echo "<script>Có lỗi trong quá trình xóa môn học</script>";
    }
}
?>