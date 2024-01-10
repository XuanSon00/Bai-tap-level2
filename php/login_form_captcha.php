<?php 
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login';
$link = mysqli_connect($servername, $username, $password, $dbname);


if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($link,$_POST['username']);
    $password = mysqli_real_escape_string($link,$_POST['password']);
    $captcha= $_POST['captcha'];
    $confirmCaptcha = $_POST['confirmCaptcha'];

    if($captcha != $confirmCaptcha){
        echo "<script>alert('Nhập sai mã captcha')</script>";
    } else {
        $sql = "SELECT *
                    FROM user_login
                    WHERE username ='$username'
                    AND   password = '$password'";
        $user_row =mysqli_query($link,$sql);
        
    if(mysqli_num_rows($user_row)>0){
        $res=mysqli_fetch_assoc($user_row);
        $_SESSION['USER_ID'] = $res['id'];
        header("location:login_dashboard.php");
    } else {
        echo "<script>alert('sai tài khoản hoặc mật khẩu')</script>";
    }
    }
}


?>

<div>
    <form action="" method="post">
        <input type="text" name='username' placeholder='username'><br><br>
        <input type="password" name='password' placeholder='password'><br><br>
        

        <span>Captcha Code</span><br>
        <input type="text" class="captcha" name="captcha" value="<?php echo substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 6); ?>" style="pointer-events: none; letter-spacing: 12px; text-decoration: line-through;"><br><br>        
        <input type="text" name="confirmCaptcha" placeholder='Enter Captcha'><br>
        <button type='submit' name='submit'>login</button>
      
        </div>

    </form>
</div>