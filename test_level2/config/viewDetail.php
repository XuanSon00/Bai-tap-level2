<?php
require 'config.php';
$course_id = $_POST['course_id'];
    //echo $course_id;
    $sql = "SELECT *
            FROM courses
            WHERE course_id = '$course_id'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result) ){
?>
<style>
    b{
        color: #e91e63;
    }
</style>
<div class="d-flex ">
    <div style='padding:40px'>
        <img src="uploads/<?php echo $row['course_image']?>" style='width: 100%'>
    </div>
    <div>
        <b>Tên môn học:</b><span> <?php echo $row['course_subject'] ?> </span><br>
        <b>Lớp: </b><span> <?php echo $row['course_class'] ?> </span><br>
        <b>Giảng viên: </b><span><?php echo $row['course_teacher'] ?></span><br>
        <b>Khóa học: </b><span> <?php echo $row['course_name'] ?> </span><br>
        <b>Mô tả:</b><span> <?php echo $row['course_description'] ?> </span><br>
        <b>Giới thiệu về lớp học :</b> <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste enim autem minus cumque porro, optio similique saepe corrupti dicta consectetur dolore unde voluptate. Consectetur quidem tempora ullam accusamus ea repellat?</span>
        <hr>
        <div><b>Học phí: </b><span><?php echo number_format($row['course_price']) ?> vnđ</span></div>
    </div>
</div>       
<?php }?>