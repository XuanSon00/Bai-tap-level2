<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'classicmodels';
$link = mysqli_connect($servername, $username, $password, $dbname);


    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Số lượng bản ghi muốn chèn
$totalRecords = 100000;



if ($link->connect_error) {
    die("Kết nối không thành công: " . $link->connect_error);
}

// Chuỗi câu SQL chèn dữ liệu
$sql = "INSERT INTO products (productCode, productName, productLine, productScale, productVendor, 
        productDescription, quantityInStock, buyPrice, MSRP)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Chuẩn bị câu lệnh SQL cho việc thêm bản ghi
$stmt = $link->prepare($sql);

// Bind các tham số vào câu lệnh SQL
$stmt->bind_param("ssssssidd", $productCode, $productName, $productLine, $productScale, $productVendor,
    $productDescription, $quantityInStock, $buyPrice, $MSRP);

// Dữ liệu mẫu để thêm vào các bản ghi
$productCode = "TEST";
$productName = "Test Product";
$productLine = "Classic Cars";
$productScale = "1:10";
$productVendor = "Test Vendor";
$productDescription = "This is a test product";
$quantityInStock = 10;
$buyPrice = 50.00;
$MSRP = 100.00;

// Thực hiện vòng lặp để thêm các bản ghi mới
for ($i = 1; $i <= $totalRecords; $i++) {
    // Thay đổi giá trị của các biến dữ liệu mẫu
    $productCode = "TEST" . $i;
    $productName = "Test Product " . $i;

    // Thực thi câu lệnh SQL
    $stmt->execute();
}


$stmt->close();
$link->close();

echo "Thêm $totalRecords bản ghi vào bảng products thành công!";
?>