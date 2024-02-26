
<?php 
session_start();
require 'config.php';
/*var_dump($_POST);
die('444');*/
if(isset($_POST['user_course_submit_form'])) {
    $user_id = $_SESSION['user_id'];
    $course_id = $_POST['course_id'];
    $course_subject = $_POST['course_subject'];
    $course_name = $_POST['course_name'];
    $course_class = $_POST['course_class'];
    $course_teacher = $_POST['course_teacher'];
    $created_at = date('Y-m-d H:i:s');
    $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "";
    
    // Kiểm tra xem người dùng đã đăng ký khóa học hay chưa
    $check_query = "SELECT * FROM user_courses WHERE user_id = '$user_id' AND course_id = '$course_id'";
    /*die('434334');*/
    $check_result = mysqli_query($link, $check_query);
    
    if($check_result) {
        $num_rows = mysqli_num_rows($check_result);
        
        if($num_rows == 0) {
            // Kiểm tra trạng thái user_active trước khi thêm vào bảng user_courses
            $user_query = "SELECT user_active FROM users WHERE user_id = '$user_id'";
            $user_result = mysqli_query($link, $user_query);
            /*die('dfdfdfsds');*/
            if($user_result) {
                $user_row = mysqli_fetch_assoc($user_result);
                $user_active = $user_row['user_active'];
                
                if($user_active != 0) {
                    // Thực hiện truy vấn INSERT để lưu thông tin vào bảng user_courses
                    $query = "INSERT INTO user_courses (user_name, user_id, course_id, course_subject, course_name, course_class, course_teacher, created_at)
                              VALUES ('$user_name', '$user_id', '$course_id', '$course_subject', '$course_name', '$course_class', '$course_teacher', '$created_at')";
                    
                    if(mysqli_query($link, $query)) {
                        header("Content-Type: application/json");
                        /*die('55');*/
                        // Đăng ký khóa học thành công
                       $response = array(
                            'success' => true,
                            'message' => 'Đăng ký khóa học thành công'
                        );
                        echo json_encode($response);
                        exit();
                        /*echo "<script>alert('Thành công');</script>";*/
                    } else {
                        echo "<script>alert('Đã có lỗi xảy ra khi đăng ký khóa học');</script>";
                    }
                } else {
                    //  user_active chưa được admin kích hoạt
                    echo "<script>alert('Vui lòng liên hệ admin để kích hoạt khóa học');</script>";
                }
            } else {
                echo "Lỗi đăng ký thông tin " ;
            }
        } else {
            echo "<script>alert('Bạn đã đăng ký khóa học này');</script>";
            echo "<script>window.location.href = '../course.php';</script>";
        }
    } else {
        echo "Lỗi kiểm tra đăng ký khóa học: ";
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

