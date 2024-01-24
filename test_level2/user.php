<?php 
include 'header.php';
require_once 'config/authentication.php';
require 'config/config.php';
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header('location: login.php');
    exit();
}



?>
<link rel="stylesheet" href="css/user.css">
<link rel="stylesheet" href="css/register.css">

 

<div class='container' style ='padding: 50px'>
<div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active btn-custom" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Thông tin chung</button>
 </div>


<?php
$result = mysqli_query($link, "	SELECT *
                                FROM users");
$row = mysqli_fetch_assoc($result);
$userID =$_SESSION['user_id'];
//var_dump($_SESSION);
/* select */
?>


  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <div>
            <div class='d-flex'>
                <h4>Thông tin cá nhân</h4>
                    <button type='button' class='btn btn-outline-dark user_info' data-bs-toggle='modal' data-bs-target='#detailModal2' data-id='<?php echo $userID; ?>' style='margin-left:auto';>
                        <i class="zmdi zmdi-edit" ></i>
                    </button>
            </div>
            
            <hr>
            <?php 
                if (isset($_SESSION['login']) && $_SESSION['login'] === true  ) {
                        echo "<div class='d-flex'>";
                        echo "  <div>
                                <b>Họ & Tên:</b>
                                <span style='margin-left:100px'>" . $_SESSION['user_name'] . " </span>
                                </div>";
                        echo "  <div>
                                <b>ID: " . sprintf("%02d", $_SESSION['user_id']) . "</b>
                                </div>";
                        echo "</div><br>";
                
                        echo "  <div>
                                <b>Tên đăng nhập:</b>
                                <span style='margin-left:35px'>" . $_SESSION['username'] . " </span>
                                </div><br>";
                        echo "  <div>
                                <b>Mật khẩu:</b>
                                <span style='margin-left:95px'>" . $_SESSION['user_pass'] . " </span>
                                </div><br>";
                        echo "  <div>
                                <b>Ngày sinh:</b>
                                <span style='margin-left:90px'>" . $_SESSION['user_birthday'] . " </span>
                                </div><br>";
                        echo "  <div>
                                <b>Email:</b>
                                <span style='margin-left:136px'>" . $_SESSION['user_email'] . " </span>
                                </div><br>";
                        echo "  <div>
                                <b>Trạng thái:</b>
                                <span style='margin-left:80px' class='" . ($_SESSION['user_active'] == 1 ? 'active-user' : 'inactive-user') . "'>
                                    " . ($_SESSION['user_active'] == 1 ? "Đã kích hoạt" : "Chưa kích hoạt") . "
                                </span>
                                </div><br>";
   
                } else {
                    echo "Bạn chưa đăng nhập.";
                }

            ?>
        </div>

    </div>





  </div>
</div>

</div>

<!---------------------------------Sửa thông tin----------------------->
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
?>

<script src="js/main.js"></script>

<script>
    //truyền ID vào form sửa thông tin
    $(document).ready(function(){
    $('.user_info').click(function(){
        var user_id = $(this).data('id');
        
        $.ajax({
            url:'config/user_edit.php',
            type:'post',
            data:{user_id :user_id},
            success: function(response){
                $('.userDetail').html(response);
                $('#detailModal2').modal('show');
            }
        })
    })
})
</script>