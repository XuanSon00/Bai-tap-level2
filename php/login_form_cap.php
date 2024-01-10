<script src= "//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login';
$link = mysqli_connect($servername, $username, $password, $dbname);
$msg= "";

    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $show_math_captcha = false;

    if (isset($_POST['submit'])) {
        $ip_address = getUserIpAddr();
    
        // Kiểm tra số lần nhập sai tên đăng nhập
        $check_attempt = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as total_count FROM attempt_count WHERE ip_address='$ip_address'"));
        $total_count = $check_attempt['total_count'];
    
        // Nếu đã nhập sai tên đăng nhập lần thứ 4, hiển thị captcha math
        if (isset($total_count) && $total_count == 3 && isset($_POST['captcha_result']) && isset($_SESSION['captcha_answer']))
         {
            $captcha_result = $_POST['captcha_result'];
            $captcha_answer = $_SESSION['captcha_answer'];
    
            // Kiểm tra phép tính captcha
            if ($captcha_result == $captcha_answer) {
                // Xóa thông tin số lần nhập sai tên đăng nhập
                mysqli_query($link, "DELETE FROM attempt_count WHERE ip_address='$ip_address'");
                continueLoginProcess($link);
            } else {
                $msg = 'Phép tính  không đúng. Vui lòng thử lại.';
            }
        } else {
            $username = mysqli_real_escape_string($link, $_POST['username']);
            $password = mysqli_real_escape_string($link, $_POST['password']);
    
            $sql = "SELECT * FROM user_login WHERE username ='$username' AND password = '$password'";
            $user_row = mysqli_query($link, $sql);
    
            // Đăng nhập thành công
            if (mysqli_num_rows($user_row) > 0) {
                $res = mysqli_fetch_assoc($user_row);
                $_SESSION['USER_ID'] = $res['id'];
                mysqli_query($link, "DELETE FROM attempt_count WHERE ip_address='$ip_address'");
                header('location: login_dashboard.php');
            } else {
                // Không thành công -> số lần nhập còn lại
                // Thêm vào cơ sở dữ liệu khi đăng nhập không thành công
                $total_count++;
                $time_remain = 3 - $total_count;
                $time = time();

                if ($time_remain <= 0) {
                    $lockout_duration = 30; // Thời gian khóa, ở đây là 30 giây
                    $lockout_time = $time + $lockout_duration;

                    mysqli_query($link, "UPDATE attempt_count SET time_count = $lockout_time WHERE ip_address = '$ip_address'");

                    $msg = 'Tài khoản đã bị khóa. Vui lòng thử lại sau 30 giây.';
                } else {
                    $msg = "Vui lòng thử lại. Còn $time_remain lần thử.";
                }

                mysqli_query($link, "INSERT INTO attempt_count (ip_address, time_count) VALUES ('$ip_address', '$time')");
            }
        }
    }
    
    // Lấy ra địa chỉ IP của người dùng
    function getUserIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    ?>
    


    <h2>Đăng nhập</h2>
    <?php if (isset($msg)) { ?>
        <p><?php echo $msg; ?></p>
    <?php } ?>
    <form method="POST" action="">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" ><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" ><br>

        <?php if (isset($total_count) && $total_count == 2) { ?>
            <label for="captcha_result">Phép tính:</label>
            <?php
            $number1 = rand(1, 10);
            $number2 = rand(1, 10);
            $operator = rand(0, 1) ? '+' : '-';
            $captcha_answer = ($operator === '+') ? $number1 + $number2 : $number1 - $number2;
            $_SESSION['captcha_answer'] = $captcha_answer;
            ?>
            <p><?php echo "$number1 $operator $number2 = ?"; ?></p>
            <input type="number" id="captcha_result" name="captcha_result" required><br>
        <?php } ?>

        <input type="submit" name="submit" value="Đăng nhập">
    </form>