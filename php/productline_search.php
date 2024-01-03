<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'classicmodels';
$link = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($link->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $link->mysqli_connect_error);
}

// Xử lý tìm kiếm
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Truy vấn MySQL để tìm kiếm dữ liệu
    $sql = "SELECT * FROM productlines WHERE productLine LIKE '%$search%'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        // Hiển thị kết quả
        echo "<table>";
        echo   "<tr><th>productLine</th>
                <th>textDescription</th>
                <th>htmlDescription</th>
                <th>image</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['productLine'] . "</td>";
            echo "<td>" . $row['textDescription'] . "</td>";
            echo "<td>" . $row['htmlDescription'] . "</td>";
            echo '<td><img src="uploads/' . $row['image'] . '" alt="Hình ảnh" style="width: 50px;"></td>';
            

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Không tìm thấy kết quả.";
    }
}

$link->close();
?>