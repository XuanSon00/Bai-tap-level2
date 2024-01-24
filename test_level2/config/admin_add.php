
<?php
require 'config.php';
//thêm dữ liệu vào cơ sở dữ liệu
if(isset($_POST['submit'])){
    $course_subject = mysqli_real_escape_string($link,$_POST['course_subject']);
    $course_name = mysqli_real_escape_string($link,$_POST['course_name']);
    $course_class = mysqli_real_escape_string($link,$_POST['course_class']);
    $course_description = mysqli_real_escape_string($link,$_POST['course_description']);
    $course_status = mysqli_real_escape_string($link,$_POST['course_status']);

//xử lý hình ảnh
    if ($_FILES['image']['error'] === 4) {
        echo "<script>alert('Không có ảnh')</script>";
    } else {
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $tmpName = $_FILES['image']['tmp_name'];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('hình ảnh không hợp lệ')</script>";
        } elseif ($fileSize > 3000000) {
            echo "<script>alert('Kích thước hình ảnh quá lớn')</script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            $imagePath = '../uploads/' . $newImageName;
            move_uploaded_file($tmpName, $imagePath);
            
            $query = "INSERT INTO courses (course_subject, course_name, course_class, course_description,course_status, course_image) 
                      VALUES (?,?,?,?,?,?)";

            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, "ssssss",$course_subject, $course_name, $course_class, $course_description, $course_status, $imagePath);
            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_affected_rows($stmt) > 0){
                echo "<script>Swal.fire({
                    title: 'The Internet?',
                    text: 'That thing is still around?',
                    icon: 'question'
                  });('Success message');
                </script>";
                //header('location:../admin.php');
            }else{
                echo "<script>alert('Thêm khóa học không thành công')</script>";
                echo "Lỗi: " . mysqli_error($link);
            }

            mysqli_stmt_close($stmt);


        }
    }
}


?>