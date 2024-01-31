<?php 
session_start();
require 'config.php';
$user_id = $_SESSION['user_id'];
   //echo $user_id;


   $sql = "SELECT *
            FROM users
            WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result) ){
 
?>
<!--Đổi thông tin cá nhân-->
<form action="config/user_edit_modal.php" method='post'>   
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
