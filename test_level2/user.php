<?php
ob_start();
$user = 'user';
include 'header.php';

if ($_SESSION['user_role'] !== '1') {
  // Nếu là user, chuyển hướng người dùng 
  header("Location: admin.php");
  //exit();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
  header('location: login.php');
  //exit();
}
?>
<link rel="stylesheet" href="css/user.css">
<link rel="stylesheet" href="css/register.css">

<div class='container' style='padding: 50px'>
  <div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Thông tin chung</button>
      <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Mật khẩu</button>
    </div>

    <div class="tab-content" id="v-pills-tabContent">
      <!--Thông tin chung-->
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <div class='d-flex'>
          <h4>Thông tin cá nhân</h4>
          <button type='button' class='btn btn-outline-dark user_info' data-bs-toggle='modal' data-bs-target='#detailModal2' data-id='<?php echo $userID; ?>' style='margin-left:auto' ;>
            <i class="zmdi zmdi-edit"></i>
          </button>
        </div><!--class='d-flex'-->
        <hr>
        <?php
        //if (isset($_SESSION['login']) && $_SESSION['login'] === true  ) {
        $sql = "SELECT * FROM users WHERE user_id = " . $_SESSION['user_id'];
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $user_name = $row['user_name'];
          $username = $row['username'];
          $user_birthday = $row['user_birthday'];
          $user_email = $row['user_email'];
          $user_active = $row['user_active'];
          $user_id = $row['user_id'];
        ?>
          <div class='d-flex'>
            <div>
              <b>Họ & Tên:</b>
              <span style='margin-left:100px'><?= $user_name ?></span>
            </div>
            <div>
              <b><?= $user_id ?></b>
            </div>
          </div><br>

          <div>
            <b>Tên đăng nhập:</b>
            <span style='margin-left:35px'> <?= $username ?></span>
          </div><br>

          <div>
            <b>Ngày sinh:</b>
            <span style='margin-left:90px'><?= $user_birthday ?></span>
          </div><br>

          <div>
            <b>Email:</b>
            <span style='margin-left:136px'><?= $user_email ?></span>
          </div><br>

          <div>
            <b>Trạng thái:</b>
            <span style='margin-left:80px' class='<?php ($user_active == 1 ? 'active-user' : 'inactive-user') ?>'>
              <?php ($user_active == 1 ? "Đã kích hoạt" : "Chưa kích hoạt") ?>
            </span>

            <?php
            if ($user_active == 1) { ?>
              <button type='button' class='btn btn-danger btn-sm ms-5' onclick='showConfirmation(". $user_id .")' name='confirmation_button'>
                <i class='fa-solid fa-x'></i>
              </button>
            <?php } else { ?>
              <button onclick='help()' class='btn-sm ms-5'>
                <i class='zmdi zmdi-help'></i>
              </button>
          <?php }
          } ?>
          </div><br>
      </div>
    </div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
      <h4>Mật khẩu</h4>
      <hr>
      <form method='post' action='config/user_edit_pass.php' style='width:400px'>
        <div class='wrap-input100 validate-input' data-validate='Enter password'>
          <span class='btn-show-pass'>
            <i class='zmdi zmdi-eye'></i>
          </span>
          <input class='input100' type='password' name='password'>
          <span class='focus-input100' data-placeholder='Nhập mật khẩu'></span>
        </div>
        <div class='wrap-input100 validate-input' data-validate='Enter password'>
          <span class='btn-show-pass'>
            <i class='zmdi zmdi-eye'></i>
          </span>
          <input class='input100' type='password' name='newPassword'>
          <span class='focus-input100' data-placeholder='Nhập mật khẩu mới'></span>
        </div>
        <div class='wrap-input100 validate-input' data-validate='Enter password'>
          <span class='btn-show-pass'>
            <i class='zmdi zmdi-eye'></i>
          </span>
          <input class='input100' type='password' name='confirmPassword' required>
          <span class='focus-input100' data-placeholder='Nhập lại mật khẩu mới'></span>
        </div>
        <button class='btn btn-primary' type='submit' name='submit'>Xác nhận</button>
      </form>"
    </div>
  </div><!--class='tab-content'-->
</div><!--class='d-flex'-->
</div><!--class='container'-->

<!---------------------------------Modal Sửa thông tin----------------------->
<div class="modal fade" id="detailModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Thông tin người dùng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body userDetail">
        <div class='d-flex'>
          <!-------------------user_edit.php--------------->
        </div>
      </div>

    </div>
  </div>
</div>
</div>
<?php
include 'footer.php';
ob_end_flush();
?>

<script src="js/main.js"></script>

<script>
  //truyền ID vào form sửa thông tin
  $(document).ready(function() {
    $('.user_info').click(function() {
      var user_id = $(this).data('id');

      $.ajax({
        url: 'config/user_edit.php',
        type: 'post',
        data: {
          user_id: user_id
        },
        success: function(response) {
          $('.userDetail').html(response);
          $('#detailModal2').modal('show');
        }
      })
    })
  })
  //Hủy kích hoạt tài khoản
  function showConfirmation(user_id) {
    Swal.fire({
      title: "Hủy kích hoạt tài khoản?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        const data = {
          user_id: user_id,
          confirm: true
        };
        $.ajax({
          url: 'config/status.php',
          type: 'POST',
          data: data,
          success: function(response) {
            Swal.fire({
              title: "Hủy thành công!",
              icon: "success"
            });
          },
          error: function(error) {
            console.error('lỗi', error);
          }
        })

      }
    });
  }
  //hiện thông báo khi chưa kích hoạt tài khoản
  function help() {
    Swal.fire({
      title: "Thông báo",
      text: "Vui lòng liên hệ Admin để được kích hoạt tài khoản!",
      icon: "warning"
    });
  }
</script>