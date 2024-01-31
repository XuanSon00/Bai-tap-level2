<?php
$page='course'; 
//include 'navbar.php';
include 'header.php';
require 'config/config.php';
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header('location: login.php');
    exit();
}

?>
<link rel="stylesheet" href="css/course.css">

<div class='body'>
<div class="container" >

    <div class="d-flex align-items-start">

    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" >Khóa học đang có</button>
        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Môn đăng ký</button>
    </div>

    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class='course' style='margin-top:20px'>
                <div class='table'>
                    <div class='total_courses'>
                    <span >Các khóa học đang có: </span>
                    <span class='course_count'>
                        <?php 
                            $query = '  SELECT COUNT(*) AS total_row 
                                        FROM courses
                                        WHERE course_status=1';
                            $result = $link->query($query);

                            if($result) {
                                $row = $result->fetch_assoc();
                                echo $row['total_row'];
                            } else {
                                echo "<p style='color:red'>lỗi</p> ";
                            }
                        ?>
                    </span>
            <?php
            $no = 1;
            $sql = "SELECT *   
                    FROM courses
                    WHERE course_status =1";
            $result = $link->query($sql);
            
            if($result ->num_rows >0) {
                echo "<table class='content-table'>";
                echo "<thead>";
                echo "  <tr>
                        <th>Id</th>
                        <th></th>
                        <th>Tên Môn Học</th>
                        <th>Tên Khóa Học</th>
                        <th>Lớp</th>
                        <th>Giảng viên</th>
                        <th></th>
                        <th>Trạng thái</th>
                        </tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr >";
                    echo "<td>".$no++. "</td>";
                    echo "<td><img src='./uploads/".$row['course_image']."'  style ='height:200px;weight:300px'></td>";
                    echo "<td>".$row['course_subject']. "</td>";
                    echo "<td>".$row['course_name']. "</td>";
                    echo "<td>".$row['course_class']. "</td>";
                    echo "<td>".$row['course_teacher']. "</td>";
                    echo "<td style='text-align:center;'>
                            <button type='button' class='btn btn-primary course_info' data-bs-toggle='modal' data-bs-target='#staticBackdrop' data-id='" . $row["course_id"] . "'>
                                View
                            </button>
                            <br>
                        </td>";
                        echo "<td>";
                            echo "<form method='post' action='config/course_detail.php'>";
                                echo "<input type='hidden' name='course_id' value='" . $row['course_id'] . "'>";
                                echo "<input type='hidden' name='course_subject' value='" . $row['course_subject'] . "'>";
                                echo "<input type='hidden' name='course_name' value='" . $row['course_name'] . "'>";
                                echo "<input type='hidden' name='course_class' value='" . $row['course_class'] . "'>"; 
                                echo "<input type='hidden' name='course_teacher' value='" . $row['course_teacher'] . "'>";             
                                echo "<button type='submit' name='user_course_submit' id='user_course_submit_btn' class='btn btn-primary'>Đăng ký</button>";
                                echo "</form>";
                        echo "</td>";
                            
                    echo "</tr>";
                    }
                echo "</tbody>";

                echo "</table>" ;       
            } else {
                echo "<script>Không có dữ liệu</script>";
            }
            ?>

                </div> <!--div class='total_courses' -->

                </div> <!--div class='table' -->
            </div> <!--div class='course' -->
        </div>



        


        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"  aria-labelledby="v-pills-profile-tab">
            <div class='course' style='margin-top:20px'>
                    <div class='table'>
                        <div class='total_courses'>
                        <span >Môn học đăng ký: </span>
                        <span class='course_count'>
                            <?php 
                                $UserID = $_SESSION['user_id'];
                                $query = "  SELECT COUNT(*) AS total_row 
                                            FROM user_courses
                                            WHERE user_id = $UserID ";
                                $result = $link->query($query);

                                if($result) {
                                    $row = $result->fetch_assoc();
                                    echo $row['total_row'];
                                } else {
                                    echo "<p style='color:red'>lỗi</p> ";
                                }
                            ?>
                        </span>
                <?php
                $no = 1;
                $sql = "SELECT *   
                        FROM user_courses
                        WHERE user_id = $UserID";
                $result = $link->query($sql);
                
                if($result ->num_rows >0) {
                    echo "<table class='content-table' >";
                    echo "<thead>";
                    echo "  <tr>
                            <th>Id</th>
                            <th>Tên Môn Học</th>
                            <th>Lớp</th>
                            <th>Khóa Học</th>
                            <th>Giảng viên</th>
                            <th>Thời gian đăng ký</th>
                            <th>Trạng thái</th>
                            </tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row=$result->fetch_assoc()){
                        echo "<tr >";
                        echo "<td>".$no++. "</td>";
                        echo "<td>".$row['course_subject']. "</td>";
                        echo "<td>".$row['course_class']. "</td>";
                        echo "<td>".$row['course_name']. "</td>";
                        echo "<td>".$row['course_teacher']. "</td>";
                        echo "<td>".$row['created_at']. "</td>";
                        echo "<td style='text-align:center;'>

                                <form method='POST' action='config/course_detail.php'>
                                    <input type='hidden' name='delete_id' value='".$row['ID']."'>
                                    <button type='submit' class='btn btn-danger' name='delete_course'>Xóa</button>
                                </form>
                                
                                <br>
                            </td>";
                                
                        echo "</tr>";
                        }
                    echo "</tbody>";

                    echo "</table>" ;       
                } else {
                    echo "<script>Không có dữ liệu</script>";
                }
                ?>

                    </div> <!--div class='total_courses' -->

                    </div> <!--div class='table' -->
                </div> <!--div class='course' -->
        </div>


    </div>

    </div>


</div>   <!--div class='container' -->
</div>   <!--div class='body' -->



<!---------------------------------Modal Xem chi tiết khóa học---------------------->


<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin khoá học</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body viewDetail">
           <!-------------------viewDetail.php--------------->
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        
      </div>
    </div>
  </div>
</div>


</div>
<?php
    include 'footer.php';
?>


<script>
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
</script>