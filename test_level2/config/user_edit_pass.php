<?php 
session_start();
require 'config.php';

   //echo $user_id;

   if(isset($_POST['submit'])){
    $user_id = $_SESSION['user_id'];
    $password = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if($newPassword === $confirmPassword) {
        $query = "SELECT user_pass FROM users WHERE user_id = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $currentPassword = $row['user_pass'];

        if(password_verify($password, $currentPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE users SET user_pass = ? WHERE user_id = ?";
            $updateStmt = mysqli_prepare($link, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "si", $hashedPassword, $user_id);
            $updateResult = mysqli_stmt_execute($updateStmt);

            if($updateResult){
                echo "<script>
                    alert('Cập nhật mật khẩu thành công');
                    window.location.href = '../user.php'; 
                </script>";
            } else {
                echo "<script>
                    alert('Lỗi cập nhật mật khẩu');
                    window.location.href = '../user.php'; 
                </script>";
            }
        } else {
            echo "<script>
                    alert('Mật khẩu hiện tại không chính xác');
                    window.location.href = '../user.php'; 
                </script>";
        }
    } else {
        echo "<script>
                alert('Mật khẩu mới không khớp');
                window.location.href = '../user.php'; 
            </script>";
    }
}


?>