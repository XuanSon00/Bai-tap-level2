<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'classicmodels';
$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Thêm dữ liệu vào bảng productlines
if (isset($_POST['add'])) {
    $productLine = strip_tags($_POST['productLine']);
    $textDescription = strip_tags($_POST['textDescription']);
    $htmlDescription = strip_tags($_POST['htmlDescription']);

    // Xử lý hình ảnh
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

            $imagePath = 'uploads/' . $newImageName;
            move_uploaded_file($tmpName, $imagePath);

            $query = "INSERT INTO productlines (productLine, textDescription, htmlDescription, image) 
                      VALUES (?, ?, ?, ?)";


            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $productLine, $textDescription, $htmlDescription, $newImageName);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('Thêm thành công');</script>";
                echo "<script>window.location.href='productline.php';</script>";
            } else {
                echo "Lỗi: " . mysqli_error($link);
            }

            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($link);
?>