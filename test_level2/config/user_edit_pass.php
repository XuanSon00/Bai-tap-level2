<?php 
session_start();
require 'config.php';

   //echo $user_id;

   if(isset($_POST['submit'])){
    $user_id = $_SESSION['user_id'];
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $newPassword = mysqli_real_escape_string($link, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($link, $_POST['confirmPassword']);
    $query = "  SELECT user_pass
                FROM users
                WHERE user_id = $user_id";
    $result= mysqli_query($link,$query);
    $row = mysqli_fetch_assoc($result);
    $currentPassword = $row['user_pass'];

    if($password === $currentPassword && password_verify($newPassword, $confirmPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery ="  UPDATE users
                        SET user_pass ='$hashedPassword'
                        WHERE user_id = $user_id";
        $updateResult= mysqli_query($link,$updateQuery);
        if($updateQuery){
            echo "<script>
                alert('cập nhật mật khẩu thành công');
                window.location.href = '../user.php'; 
            </script>";
        } else{
            echo "<script>
                alert('Lỗi cập nhật mật khẩu');
                window.location.href = '../user.php'; 
            </script>";
        }
    } else{
        echo "<script>
                alert('Mật khẩu không khớp');
                window.location.href = '../user.php'; 
            </script>";
    }
}

?>