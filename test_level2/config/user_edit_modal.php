<?php 
session_start();
require 'config.php';

if (isset($_POST['submit']))  {
    //var_dump($_POST);
    $user_id = $_POST['user_id'];
    $user_name = mysqli_real_escape_string($link,$_POST['user_name']);
    $user_birthday = $_POST['date'];
    $user_email =mysqli_real_escape_string($link,$_POST['email']);
    $updated_at = date('d-m-Y H:i:s');
    /*$duplicate= mysqli_query($link,"SELECT *
                                        FROM users
                                        WHERE user_email= '$user_email'");*/
    
    if(strpos($user_email, '@') === false){
        echo "<script>alert('Email không hợp lệ')</script>";
    } else{     
            $editSQL = "UPDATE users
                        SET user_name ='$user_name',  user_birthday='$user_birthday', user_email='$user_email', updated_at=NOW()
                        WHERE user_id ='$user_id'";
            $resultSql= mysqli_query($link,$editSQL);

            
            if($resultSql) {
                echo "<script>
                alert('Cập nhật thông tin thành công')
                window.location.href = '../user.php'; 
                </script>";
                exit();
            } else{
                echo "<script>alert('lỗi cập nhật')
                window.location.href = '../user.php'; 
            </script>";
            }
}
}
?>