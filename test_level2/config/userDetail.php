<?php
require 'config.php';
$user_id = $_POST['user_id'];
   // echo $user_id;

   $sql = "SELECT *
            FROM users
            WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result) ){
?>

<style>
    b{
        color: #e91e63;
    }

    table thead tr th{
        padding: 10px;
        text-align: center;
    }
    table tbody tr td{
        padding: 10px;
        text-align: center;
    }


</style>


<div>

    <div>
        <table>
            <thead>
                <tr>
                    <th><b>Tên Người dùng</b></th>
                    <th><b>Ngày sinh</b></th>
                    <th><b>Email</b></th>
                    <th><b>Tên đăng nhập</b></th>
                    <th><b>Mật khẩu</b></th>
                    <th><b>Kích hoạt tài khoản</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row['user_name'] ?></td>
                    <td><?php echo $row['user_birthday'] ?></td>
                    <td><?php echo $row['user_email'] ?></td>
                    <td><span> <?php echo $row['username'] ?></td>
                    <td><?php echo $row['user_pass'] ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>       
    
<?php }
?>
