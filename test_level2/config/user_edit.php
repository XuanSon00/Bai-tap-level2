<?php 
session_start();
require 'config.php';
$user_id = $_SESSION['user_id'];
   //echo $user_id;


if(!empty($_POST['submit'])) {
    $user_name = mysqli_real_escape_string($link,$_POST['user_name']);
    $user_birthday = $_POST['date'];
    $user_email =mysqli_real_escape_string($link,$_POST['email']);
    $updated_at = date('d-m-Y H:i:s');
    $duplicate= mysqli_query($link,"SELECT *
                                        FROM users
                                        WHERE user_email= '$user_email'");
    
    if (mysqli_num_rows($duplicate) > 0){
        echo "<script>alert('Email đã được đặt')</script>";
    }elseif(strpos($user_email, '@') === false){
        echo "<script>alert('Email không hợp lệ')</script>";
    } else{     
            $editSQL = "UPDATE users
                        SET user_name ='$user_name',  user_birthday='$user_birthday', user_email='$user_email', updated_at='$updated_at'
                        WHERE user_id ='$user_id'";
            $resultSql= mysqli_query($link,$editSQL);
            if (!$resultSql){
                echo "lỗi"
            }
            /*
            if($resultSql) {
                echo "<script>alert('cập nhật thành công')</script>";
                header('location:../user.php');
                exit();
            } else{
                echo "<script>alert('lỗi cập nhật')</script>";
            }*/
}
}
   $sql = "SELECT *
            FROM users
            WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result) ){
 
?>

<form action="" method='post'>   
    <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">   
    <div class="wrap-input100 validate-input" >
        <input class="input100" type="text" name="user_name" required value="<?php echo $row['user_name'] ?>">
        <span class="focus-input100" ></span>
    </div>

    <div class=" d-flex" >
        <label for="date" class='input100' >Ngày sinh:</label>
        <input type="date" id="date" name="date" style='width: 100%; font-size: 20px' >
    </div>

    <div class="wrap-input100 validate-input" >
        <input class="input100" type="text" name="email" required value="<?php echo $row['user_email'] ?>">
        <span class="focus-input100" ></span>
    </div>
    
                      
       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" name='submit'>Lưu</button>
      </div> 
    </form>


    <?php 
    }
    ?>