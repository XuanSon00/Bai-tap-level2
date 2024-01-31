<?php
$page='admin'; 
require 'config/config.php';
include 'header.php';
require_once 'config/authentication.php';
?>
<!--------------------CSS FILE------------------------------------->
<link rel="stylesheet" href="css/register.css">
<link rel="stylesheet" href="css/admin.css">
<!----------------------------------------------------------------->
<div class="container course-table">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Danh sách môn học</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Danh sách Người dùng</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="teacher-tab" data-bs-toggle="tab" data-bs-target="#teacher-tab-pane" type="button" role="tab" aria-controls="teacher-tab-pane" aria-selected="false">Danh sách Giảng Viên</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="teachSubject-tab" data-bs-toggle="tab" data-bs-target="#teachSubject-tab-pane" type="button" role="tab" aria-controls="teachSubject-tab-pane" aria-selected="false">Giảng viên môn học</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <!---------------------------Tab danh sách khóa học--------------------------------------->
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <form action="" style='margin:0' method='post'>
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
                    echo "<table class='content-table' id='Course'>";
                    echo "<thead>";
                    echo "  <tr>
                            <th>Id</th>
                            <th></th>
                            <th>Tên Môn học</th>
                            <th>Tên khóa học</th>
                            <th>Lớp</th>
                            <th>Giảng viên</th>
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
                        echo "<td>".$row['course_teacher']. "</td>";
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
        </div><!--div home-tab-->
        
        


    <!---------------------------Tab danh sách người dùng--------------------------------------->
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <form action="" style='margin:0' method='post'>              
    <div class='d-flex'>
        <div class='total_courses'>
            <span >Danh sách người dùng đăng ký: </span>
            <span class='course_count'>
                <?php 
                    $query = 'SELECT COUNT(*) AS total_row FROM users WHERE user_role <> 0';
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
            $sql = "UPDATE users 
                    SET user_active = 1 
                    WHERE user_id = $userId";
            $link->query($sql);
        }
    ?>

    <div class='course' style='margin-top:20px'>
        <div class='table'>
            <?php
            $no = 1;
            $sql = "SELECT * FROM users WHERE user_role <> 0";
            $result = $link->query($sql);
            
            if($result->num_rows > 0) {
                echo "<table class='content-table' id='User' style='width:100%'>";
                echo "<thead>";
                echo "<tr>
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
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
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
                        
                        <form action='config/delete.php' method='post' style='margin:0'>
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
                echo "</table>";
            } else {
                echo "<p>Không có dữ liệu</p>";
            }
            ?>
        </div>
    </div>
</form>
        </div><!--div profile-tab-->
        <!--Tab danh sách giảng viên-->
        <div class="tab-pane fade" id="teacher-tab-pane" role="tabpanel" aria-labelledby="teacher-tab" tabindex="0">
        <form action="" style='margin:0' method='post'>
                <div class='d-flex'>
                    <div class='total_courses'>
                        <span >Giảng viên: </span>
                        <span class='course_count'>
                            <?php 
                                $query = 'SELECT COUNT(*) AS total_row FROM teachers';
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal3">
                    <i class="zmdi zmdi-plus-circle-o"></i>
                        Thêm giảng viên
                    </button>
                    </div>


                </div>

                <div class='course' style='margin-top:20px'>
                    <div class='table'>
                <?php
                $no = 1;
                $sql = "SELECT *   
                        FROM teachers";
                $result = $link->query($sql);
                
                if($result ->num_rows >0) {
                    echo "<table class='content-table w-100' id='Teacher'>";
                    echo "<thead>";
                    echo "  <tr>
                            <th>Id</th>
                            <th>Tên Giảng Viên</th>
                            <th>Ngày Sinh</th>
                            <th>Email</th>
                            <th>Ngày thêm vào</th>
                            <th>Trạng thái</th>
                            </tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row=$result->fetch_assoc()){
                        echo "<tr >";
                        echo "<td>".$no++. "</td>";
                        echo "<td>".$row['teacher_name']. "</td>";
                        echo "<td>".$row['teacher_birthday']. "</td>";
                        echo "<td>".$row['teacher_email']. "</td>";
                        echo "<td>".$row['created_at']. "</td>";
                        echo "<td style='text-align:center;'>
                                <form action='config/delete.php' method='post'style='margin:0'>
                                    <input type='hidden' name='id' value='{$row['teacher_id']}' />                            
                                    <input type='submit' name='delete' class='btn btn-danger' value='Delete' />                            
                                </form>
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
        </div><!--div teacher-tab-->

        <!--Tab danh sách môn học cho giảng viên-->
        <div class="tab-pane fade" id="teachSubject-tab-pane" role="tabpanel" aria-labelledby="teachSubject-tab" tabindex="0">
        <form action="" style='margin:0' method='post'>
                <div class='d-flex'>
                    <div class='total_courses'>
                       
                    </div>

                

                    <div style='margin-left: auto' >
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal4">
                    <i class="zmdi zmdi-plus-circle-o"></i>
                        Thêm 
                    </button>
                    </div>


                </div>

                <div class='course' style='margin-top:20px'>
                    <div class='table'>
                <?php
                $no = 1;
                $sql = "SELECT subjects.subject_id, teachers.teacher_id, subjects.subject_name, teachers.teacher_name
                        FROM teach_subject
                        JOIN subjects ON teach_subject.subject_id = subjects.subject_id
                        JOIN teachers ON teach_subject.teacher_id = teachers.teacher_id";              
                $result = $link->query($sql);
                
                
                if($result ->num_rows >0) {
                    echo "<table class='content-table w-100' id='TeachSubject'>";
                    echo "<thead>";
                    echo "  <tr>
                            <th>Id</th>
                            <th>Tên Giảng viên</th>
                            <th>ID Giảng Viên</th>
                            <th>Tên Môn Học</th>
                            <th>ID Môn Học</th>   
                            <th></th>
                            </tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row=$result->fetch_assoc()){
                        echo "<tr >";
                        echo "<td>".$no++. "</td>";
                        echo "<td>".$row['teacher_name']. "</td>";
                        echo "<td>".$row['teacher_id']. "</td>";
                        echo "<td>".$row['subject_name']. "</td>";
                        echo "<td>".$row['subject_id']. "</td>";
                        echo "<td>
                        <form action='config/delete.php' method='post' style='margin:0'>
                                <input type='hidden' name='id' value='{$row['teacher_id']}' />                            
                                <input type='submit' name='delete' class='btn btn-danger' value='Delete' />                            
                            </form>";

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
        </div><!--div teacher-tab-->

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
                <?php 
                    $query="SELECT subject_name
                            FROM subjects";
                    $result= mysqli_query($link,$query);
                    if($result > 0){
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<option value=" '. $row['subject_name'] . '" >' . $row['subject_name'] .'</option>';
                        }
                    }
                ?>
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
            <select class="form-select" name='course_teacher'>
                <option selected disabled>--Giảng viên--</option>
                <?php 
                    $query="SELECT teacher_name
                            FROM teachers";
                    $result= mysqli_query($link,$query);
                    if($result > 0){
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<option value=" '. $row['teacher_name'] . '" >' . $row['teacher_name'] .'</option>';
                        }
                    }
                ?>
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
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" name='submit'>Lưu</button>
      </div> 
    </form>
    </div>
  </div>
</div>


<!---------------------------------Modal Thêm giảng viên----------------------->
<div class="modal" id="AddModal3">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Thêm thông tin giảng viên -->
      <div class="modal-header">
        <h5 class="modal-title">Thêm Giảng viên</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="config/admin_teacher.php" method='post'>
         <div class="modal-body">
            

            <div class="wrap-input100 validate-input" >
            <select class="form-select" name='teacher_name'>
                <option selected disabled>--Chọn giảng viên--</option>
                <option value="Lê Văn A">Lê Văn A</option>
                <option value="Lê Văn B">Lê Văn B</option>
                <option value="Lê Văn C">Lê Văn C</option>
                <option value="Lê Văn D">Lê Văn D</option>
                <option value="Lê Văn E">Lê Văn E</option>
                <option value="Lê Văn F">Lê Văn F</option>
                <option value="Lê Văn G">Lê Văn G</option>
                <option value="Lê Văn H">Lê Văn H</option>
            </select>
			</div>



            <div class="wrap-input100 validate-input" >
				<input class="input100" type="text" name="teacher_email" >
				<span class="focus-input100" data-placeholder="Nhập email"></span>
			</div>

            <div class=" d-flex" >
                <label for="date" class='input100'>Ngày sinh:</label>
                <input type="date" id="date" name="teacher_date" style='width: 100%; font-size: 20px' >
			</div>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" name='submit'>Lưu</button>
      </div> 
    </form>
    </div>
  </div>
</div>

<!---------------------------------Modal Môn học cho giảng viên----------------------->
<div class="modal" id="AddModal4">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Thêm môn học cho giảng viên -->
      <div class="modal-header">
        <h5 class="modal-title">Thêm Giảng viên Môn học</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="config/admin_teachSubject.php" method='post'>
         <div class="modal-body">        
         <div class="wrap-input100 validate-input" >
            <select class="form-select" name='teacher_id'>
                <option selected disabled>--Giảng viên--</option>
                <?php 
                    $query="SELECT *
                            FROM teachers";
                    $result= mysqli_query($link,$query);
                    if($result > 0){
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<option value=" '. $row['teacher_id'] . '" >' . $row['teacher_name'] .'</option>';
                        }
                    }
                ?>
            </select>

            
		</div>



        <div class="wrap-input100 validate-input" >
            <select class="form-select" name='subject_id'>
            <option selected disabled>--Môn học--</option>
                <?php 
                    $query="SELECT *
                            FROM subjects";
                    $result= mysqli_query($link,$query);
                    if($result > 0){
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<option value=" '. $row['subject_id'] . '" >' . $row['subject_name'] .'</option>';
                            //echo '<input type="hidden" name="subject_id" value ="'.$row['subject_id'].'" />';
                            //echo '<input type="hidden" name="subject_des" value ="'.$row['subject_des'].'" />';
                        }
                    }
                ?>
            </select>
            <!--<input type="hidden" name='teacher_id' value="">-->
            <!--<input type="hidden" name='teacher_id' value="">-->
            </div>

      </div>
      <div class="modal-footer ">
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


//Bảng DataTable
new DataTable('#Course');
new DataTable('#User');
new DataTable('#Teacher');
new DataTable('#TeachSubject');


</script>

