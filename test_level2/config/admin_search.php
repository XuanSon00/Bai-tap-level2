<?php 
require 'config.php';
$no = 1;
?>

<?php 
if(isset($_GET['search'])){
    $search = $_GET['search'];

    $sql = "SELECT * 
            FROM courses
            WHERE course_name LIKE '%$search%'";
    $result = mysqli_query($link, $sql);

    if($result->num_rows > 0) {
        //hiển thị kết quả
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
        while($row = $result->fetch_assoc()){
            echo "<tr>";
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
        echo "</table>";
    } else{
        echo 'Không tìm thấy kết quả';
    }
}
?>