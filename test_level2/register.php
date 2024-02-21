<?php
$page = 'register';
include 'header.php';
include 'config/config.php';
?>
<link rel="stylesheet" href="css/register.css">


<?php
if (isset($_POST['submit'])) {

	$user_name = mysqli_real_escape_string($link, $_POST['user_name']); // Dư
	$username = $_POST['username'];
	//var_dump(strip_tags($_POST['username']));die();
	$password = mysqli_real_escape_string($link, $_POST['password']);
	$confirmPassword = mysqli_real_escape_string($link, $_POST['confirmPassword']);
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$date = $_POST['date'];
	$birthday = date('d-m-Y', strtotime($date));
	$create_at = date('d-m-Y H:i:s');
	/*
				Thực hiện xử lý kiểm tra hợp lệ trước khi sử dụng truy vấn
				- Kiểm tra mật khẩu và xác nhận mật khẩu xem có khớp không rồi mới thực hiện tiếp
				if ($password == $confirmPassword) {
					// Thông báo lỗi
				}
				- Kiểm tra hợp lệ email, sử dụng mysqli prepared, nên không cần dùng mysqli_real_escape_string
				- Kiểm tra trùng username hoặc email
				- Thêm vào người dùng sử dụng mysqli prepared

				- Sử dụng strip_tags với tên người dùng
				- username phải gồm các ký tự số và chữ
				- email gồm các ký tự số và chữ
				- 
				*/

	$stmt = mysqli_prepare($link, "SELECT * FROM users WHERE username = ? OR user_email = ?");
	mysqli_stmt_bind_param($stmt, "ss", $username, $email);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$duplicate = mysqli_query($link, "SELECT *
                                        FROM users
                                        WHERE username ='$username'
                                        OR user_email= '$email'");
	if (mysqli_num_rows($duplicate) > 0) {
		echo "<script>Swal.fire({
				icon: 'error',
				title: 'Lỗi',
				text: 'Tên đăng nhập hoặc địa chỉ Email đã được đặt!',
			  });
			  </script>";
	} elseif (strpos($email, '@') === false) {
		echo "<script>Swal.fire({
				icon: 'error',
				title: 'Lỗi',
				text: 'Địa chỉ email không hợp lệ!',
			  });
			  </script>";
	} else {
		if ($password == $confirmPassword) {
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			//$password = md5($password);
			$query = "  INSERT INTO users (user_name, username, user_pass, user_email, user_birthday, created_at, user_role, user_active)
                            VALUES ('$user_name','$username', '$hashedPassword', '$email', '$birthday', NOW(), 1, 0)";
			mysqli_query($link, $query);
			echo "<script>Swal.fire({
					title: 'Đăng ký thành công!',
					icon: 'success'
				  });</script>";
		} else {
			echo "<script>Swal.fire({
					icon: 'error',
					title: 'Lỗi',
					text: 'Mật khẩu không khớp!',
				  });
				  </script>";
		}
	}
}
?>




<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<form class="login100-form validate-form" method="post">
				<span class="login100-form-title p-b-26">
					Đăng ký
				</span>
				<span class="login100-form-title p-b-48">
					<i class="zmdi zmdi-account-circle"></i>
				</span>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="user_name" required>
					<span class="focus-input100" data-placeholder="Nhập họ và tên "></span>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="username" required>
					<span class="focus-input100" data-placeholder="Nhập tên đăng nhập"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
					<span class="btn-show-pass">
						<i class="zmdi zmdi-eye"></i>
					</span>
					<input class="input100" type="password" name="password" required>
					<span class="focus-input100" data-placeholder="Nhập mật khẩu"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter confirm password">
					<span class="btn-show-pass">
						<i class="zmdi zmdi-eye"></i>
					</span>
					<input class="input100" type="password" name="confirmPassword" required>
					<span class="focus-input100" data-placeholder="Nhập lại mật khẩu"></span>
				</div>

				<div class=" d-flex">
					<label for="date" class='input100'>Ngày sinh:</label>
					<input type="date" id="date" name="date" style='width: 100%; font-size: 20px'>
				</div>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="email" required>
					<span class="focus-input100" data-placeholder="Nhập địa chỉ email"></span>
				</div>


				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
						<button class="login100-form-btn" type="submit" name="submit">
							Đăng ký
						</button>
					</div>
				</div><br><br>

				<div class="text-center p-t-115">
					<span class="txt1">
						Đã có tài khoản
					</span>

					<a class="txt2" href="login.php">
						Đăng nhập
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include 'footer.php';
?>
<script src="js/main.js"></script>