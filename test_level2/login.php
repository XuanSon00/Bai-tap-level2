<?php
	$page='login'; 
	include 'header.php';
	require 'config/config.php';
?>
<link rel="stylesheet" href="css/register.css">

<?php 
	if (isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($link,$_POST['username']);
		$password = mysqli_real_escape_string($link,$_POST['password']);
		$result = mysqli_query($link, "SELECT *
										FROM users
										WHERE username ='$username'");
		/*
		Sử dụng prepared trong câu sql ở trên để hạn chế lỗi sql injection
		*/
		$row = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result) > 0) {
			if (password_verify($password, $row['user_pass'])) {
				$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['login']=true;
					$_SESSION['id']= $row['user_id'];
					$_SESSION['user_role']= $row['user_role'];
				if ($row['user_role'] == 1) { // người dùng
					//$_SESSION['login']=true;
					//$_SESSION['id']= $row['user_id'];
					//$_SESSION['user_role']= $row['user_role'];
					header('location:user.php');
					//exit();
				//} elseif ($row['user_role'] == 0) { //admin
				} else {
					//$_SESSION['login']=true;
					//$_SESSION['id']= $row['user_id'];
					//$_SESSION['user_role']= $row['user_role'];
					header('location:admin.php');
					//exit();
				}
			} else {
				echo "<script>Swal.fire({
					icon: 'error',
					title: 'Lỗi',
					text: 'Mật khẩu không đúng!', //=> Mật khẩu hoặc tên đăng nhập không đúng
					});
					</script>";
			}
		} else {
			echo "<script>Swal.fire({
				icon: 'error',
				title: 'Lỗi',
				text: 'Tài khoản không hợp lệ!', // => Tài khoản không tồn tại
				});
				</script>";
		}
	}
?>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-26">
						Đăng nhập
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-account-circle"></i>
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type='submit' name='submit'>
								Login
							</button>
						</div>
					</div><br><br>

					<div class="text-center p-t-115">
						<span class="txt1">
							Đăng ký tài khoản
						</span>

						<a class="txt2" href="register.php">
							Sign Up
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
