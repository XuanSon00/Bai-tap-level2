<?php
$page='admin'; 
require 'config/config.php';
include 'header.php';
require_once 'config/authentication.php';
?>
<link rel="stylesheet" href="css/register.css">
<link rel="stylesheet" href="css/admin.css">

<div class="container">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Danh sách khóa học</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Danh sách người dùng</button>
            </li>
        </ul>

    <div class="tab-content" id="pills-tabContent">
                   <!--Tab danh sách khóa học-->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <form action="config/admin_search.php" meth='GET' class='d-flex' style='margin:0' id="search-form">
                <input class="form-control me-2 search searchId" name ='search' type="search" placeholder="Tìm kiếm..." aria-label="Search" >
                <button class="searchBtn"  type="submit" style ='background-color:#e91e63; width:50px '><i class='fa fa-search'></i></button>
            </form>

        <form action="" style='margin:0'>
            <div class='d-flex'>
                <div class='total_courses'>
                    <span >Các khóa học đang có: </span>
                    <span class='course_count'>
                        <?php 
                            $query = 'SELECT COUNT(*) AS total_row FROM courses';
                            $result = $link->query($query);

                            if($result) {
                                $row = $result->fetch_assoc();
                                echo $row['total_row'];
                            } else {
                                echo "<p style='color:red'>lỗi</p> ";
                            }
                        ?>
                    </span>
                </div>

            

                <div style='margin-left: auto' >
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">
                <i class="zmdi zmdi-plus-circle-o"></i>
                    Thêm khóa học
                </button>
                </div>


            </div>

            <div class='course' style='margin-top:20px'>
                <div class='table'>
            <?php
            $no = 1;
            $sql = "SELECT *   
                    FROM courses";
            $result = $link->query($sql);
            
            if($result ->num_rows >0) {
                echo "<table class='content-table'>";
                echo "<thead>";
                echo "  <tr>
                        <th>Id</th>
                        <th></th>
                        <th>Tên Môn học</th>
                        <th>Tên khóa học</th>
                        <th>Lớp</th>
                        <th>Mô tả</th>
                        <th></th>
                        <th>Trạng thái</th>
                        </tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr >";
                    echo "<td>".$no++. "</td>";
                    echo "<td><img src='./uploads/".$row['course_image']."' ></td>";
                    echo "<td>".$row['course_subject']. "</td>";
                    echo "<td>".$row['course_name']. "</td>";
                    echo "<td>".$row['course_class']. "</td>";
                    echo "<td>".$row['course_description']. "</td>";
                    echo "<td style='text-align:center;'>
                            <button type='button' class='btn btn-primary course_info' data-bs-toggle='modal' data-bs-target='#staticBackdrop' data-id='" . $row["course_id"] . "'>
                                View
                            </button><br>
                            
                                <form action='config/delete.php' method='post'style='margin:0'>
                                    <input type='hidden' name='id' value='{$row['course_id']}' />                            
                                    <input type='submit' name='delete' class='btn btn-danger' value='Delete' />                            
                                </form>
                            
                        </td>";
                    echo "<td>";
                        if ($row['course_status'] == 1) {
                            echo '<p><a href="config/status.php?Id='.$row['course_id'].'&course_status=0" class= "btn btn-primary">Mở</a></p>';
                        } else  {
                            echo '<p><a href="config/status.php?Id='.$row['course_id'].'&course_status=1" class= "btn btn-danger">Đóng</a></p>';
                        }
                    echo "</td>";
                            
                    echo "</tr>";
                    }
                echo "</tbody>";

                echo "</table>" ;       
            } else {
                echo "<script>Không có dữ liệu</script>";
            }
            
            //var_dump($row)
            
            ?>

                </div>
            </div>
        </form>

        </div>

        <div id="search-results">
    <?php

    //Kết quả tìm kiếm được xử lý từ config/admin_search.php

    ?>
    </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
           <!--Tab danh sách người dùng-->
           <form action="" style='margin:0'>
        <div class='d-flex'>
            <div class='total_courses'>
                <span >Danh sách người dùng đăng ký: </span>
                <span class='course_count'>
                    <?php 
                        $query = '  SELECT COUNT(*) AS total_row 
                                    FROM users
                                    WHERE user_role <>0'; //lọc ra hàng trong bảng giá trị khác 0
                        $result = $link->query($query);

                        if($result) {
                            $row = $result->fetch_assoc();
                            echo $row['total_row'];
                        } else {
                            echo "<p style='color:red'>lỗi</p> ";
                        }
                    ?>
                </span>
            </div>

        </div>



<?php 
    if(isset($_POST['user_active'])){
        $userId = $_POST['user_active'];
        $sql = "UPDATE users SET user_active = 1 WHERE user_id = $userId";
        // Thực thi truy vấn để cập nhật giá trị cột user_active thành 1 cho người dùng có user_id tương ứng
        $link->query($sql);
    }
?>
        <div class='course' style='margin-top:20px'>
            <div class='table'>
        <?php
        $no = 1;
        $sql = "SELECT *   
                FROM users
                WHERE user_role <>0";//lọc ra hàng trong bảng giá trị khác 0(không tính tài khoản admin)
                
        $result = $link->query($sql);
        
        if($result ->num_rows >0) {
            echo "<table class='content-table'>";
            echo "<thead>";
            echo "  <tr>
                        <th>Id</th>
                        <th>Tên người dùng </th>
                        <th>Ngày sinh</th>
                        <th>Email</th>
                        <th>Ngày tạo</th>
                        <th></th>
                        <th>Kích hoạt</th>
                    </tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row=$result->fetch_assoc()){
                echo "<tr >";
                echo "<td>".$no++. "</td>";
                echo "<td>".$row['user_name']. "</td>";
                echo "<td>".$row['user_birthday']. "</td>";
                echo "<td>".$row['user_email']. "</td>";    
                echo "<td>".$row['created_at']. "</td>";
                echo "
                <td style='text-align:center;'>
                        <button type='button' class='btn btn-primary user_info' data-bs-toggle='modal' data-bs-target='#detailModal2' data-id='" . $row["user_id"] . "'>
                            View
                        </button><br>
                        
                            <form action='config/delete.php' method='post'style='margin:0'>
                                <input type='hidden' name='id' value='{$row['user_id']}' />                            
                                <input type='submit' name='delete' class='btn btn-danger' value='Delete' />                            
                            </form>
                        
                    </td>";  
                echo "<td>
                    <div class='form-check form-switch'>
                    <input type='hidden' name='user_id' value='" . $row['user_id'] . "' />
                    <input class='form-check-input' type='checkbox' name='user_active' role='switch' data-id='" . $row['user_id'] . "' " . ($row['user_active'] == 1 ? 'checked' : '') . ">
                    </div>
                    
                    </td>";
                echo "</tr>";
                 }
            echo "</tbody>";

            echo "</table>" ;       
        } else {
            echo "<script>Không có dữ liệu</script>";
        }
        
        //var_dump($row)
   
        ?>

            </div>
        </div>
    </form>
        </div>



    </div><!--div class="tab-content"-->
</div> <!--div class="container"-->



<!---------------------------------Modal Thêm khóa học----------------------->
<div class="modal" id="AddModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Thêm thông tin khóa học -->
      <div class="modal-header">
        <h5 class="modal-title">Thêm khóa học</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="config/admin_add.php" method='post' enctype ='multipart/form-data'>
         <div class="modal-body">
            

            <div class="wrap-input100 validate-input" >
            <select class="form-select" name='course_subject'>
                <option selected disabled>--Chọn Môn Học--</option>
                <option value="Toán Học">Toán Học</option>
                <option value="Vật Lý">Vật Lý</option>
                <option value="Hóa Học">Hóa Học</option>
                <option value="Tiếng Anh">Tiếng Anh</option>
                <option value="Ngữ Văn">Ngữ Văn</option>
                <option value="Sinh Học">Sinh Học</option>
                <option value="Lịch Sử">Lịch Sử</option>
                <option value="Địa Lý">Địa Lý</option>
            </select>
			</div>

            <div class="wrap-input100 validate-input" >
            <select class="form-select" name='course_class'>
                <option selected disabled>--Chọn lớp--</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
			</div>

            <div class="wrap-input100 validate-input" >
            <select class="form-select" name='course_name'>
                <option selected disabled>--Chọn khóa học--</option>
                <option value="Khóa học Trực tiếp">Trực tiếp</option>
                <option value="Khóa học Online">Online</option>
            </select>
			</div>


        
            <div class="wrap-input100 validate-input" >
				<input class="input100" type="text" name="course_description" >
				<span class="focus-input100" data-placeholder="Mô tả "></span>
			</div>

            <div class="wrap-input100 validate-input" >
            <select class="form-select" name='course_status'>
                <option selected disabled>--Trạng thái lớp học--</option>
                <option value="0" >Đóng</option>
                <option value="1">Mở</option>
            </select>
			</div>

            <div class="" >
            <input type="file" name="image" placeholder='Enter Name' id='image' onchange="getImagePreview(event)">
			<div id='preview'></div>
			</div>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" name='submit'>Lưu</button>
      </div> 
    </form>
    </div>
  </div>
</div>


<!---------------------------------Modal Xem chi tiết khóa học---------------------->
<div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Thông tin khóa học</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body viewDetail">
        <div class='d-flex'>
           <!-------------------viewDetail.php--------------->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<!---------------------------------Modal Xem chi tiết người dùng---------------------->
<div class="modal fade" id="detailModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Thông tin người dùng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body userDetail">
        <div class='d-flex'>
           <!-------------------userDetail.php--------------->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>


<!---------------------------------Footer---------------------->
<?php 
include 'footer.php';
?>


<!---------------------------------Javascript---------------------->
<script src="js/main.js"></script>
<script>
    //hiển thị hình ảnh trước khi lưu lại
    function getImagePreview(event) {
  var image = URL.createObjectURL(event.target.files[0]);
  var imagediv = document.getElementById('preview');
  imagediv.innerHTML = '';
  var newImg = document.createElement('img');
  newImg.src = image;
  newImg.width = 80;
  imagediv.appendChild(newImg);
}

//truyền id vào modal -> xem chi tiết khóa học
$(document).ready(function(){
    $('.course_info').click(function(){
        var course_id = $(this).data('id');
        //alert(course_id)
        $.ajax({
            url:'config/viewDetail.php',
            type:'post',
            data:{course_id :course_id},
            success: function(response){
                $('.viewDetail').html(response);
                $('#detailModal').modal('show');
            }
        })
    })
})

//truyền id vào modal -> xem chi tiết người dùng
$(document).ready(function(){
    $('.user_info').click(function(){
        var user_id = $(this).data('id');
        
        $.ajax({
            url:'config/userDetail.php',
            type:'post',
            data:{user_id :user_id},
            success: function(response){
                $('.userDetail').html(response);
                $('#detailModal2').modal('show');
            }
        })
    })
})

//kích hoạt trạng thái của người dùng
$(document).ready(function () {
        $('.form-check-input').on('change', function () {
            var userId = $(this).data('id');
            var isChecked = $(this).prop('checked') ? 1 : 0;

            // Sử dụng AJAX để gửi yêu cầu cập nhật dữ liệu đến server
            $.ajax({
                type: 'POST',
                url: 'config/activeUser.php', 
                data: {
                    user_id: userId,
                    user_active: isChecked
                },
                success: function (response) {
                    console.log(response);
                    if (isChecked) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        });
    });


//Thanh tìm kiếm
$(document).ready(function() {
    $('#search-form').submit(function(event) {
        event.preventDefault();

        var searchData = $(this).serialize();

        $.ajax({
            type:"GET",
            url:'config/admin_search.php',
            data: searchData,
            success: function(response){
                //cập nhật kết quả tìm kiếm trên admin.php
            $('#search-results').html(response);
            }
        });
    });
});

</script>

