<head>
    <link rel="stylesheet" type="text/css" href="productline.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'classicmodels';
$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

//phân trang
$start = 0;
$rows_per_page = 5; //số dòng hiển thị
$record = $link->query("SELECT * 
                        FROM productlines");
$number_of_rows = $record->num_rows; // tổng số dòng trong csdl

$pages = ceil($number_of_rows / $rows_per_page);

if(isset($_GET['page-number'])){
    $page = $_GET['page-number'] - 1;
    $start = $page * $rows_per_page;
};


// Lấy dữ liệu từ bảng productlines
$sql = "SELECT * 
        FROM productlines 
        LIMIT $start,$rows_per_page"; // Truy vấn lấy dữ liệu từ bảng productlines
$result = $link->query($sql); //truy vấn và lưu kết quả vào biến $result
?>

<!------------------tìm kiếm---------------------------->
<form method="GET" action="productline_search.php">
    <input type="text" name="search" placeholder="Tìm kiếm...">
    <input type="submit" value="Tìm kiếm">
</form>

    
    <table border=1 cellspacing = 0 cellpadding = 10>
        <tr>
            <th>Product Line</th>
            <th>Text Description</th>
            <th>HTML Description</th>
            <th>Image</th>
            <th></th>
        </tr>
        
        
    <?php
    if ($result->num_rows > 0) {
        foreach ($result as $row):
            ?>
            <tr>
                <td><?php echo $row['productLine']; ?></td>
                <td><?php echo $row['textDescription']; ?></td>
                <td><?php echo $row['htmlDescription']; ?></td>
                <td><img src="uploads/<?php echo $row['image']; ?>" alt="Hình ảnh" style="width: 50px;"></td>
                <td><button class="editButton" >Sửa</button></td>
            </tr>
            <?php
        endforeach;
    } else {
        echo "<tr><td colspan='4'>Không có dữ liệu để hiển thị.</td></tr>";
    }
    ?>
</table>




<!------------------phân trang---------------------------->
<div class='page'>
    <a href="?page-number=1">First</a>

    <?php 
        if(isset($_GET['page-number']) && $_GET['page-number'] >1){
        ?>
    <a href ="?page-number=<?php echo $_GET['page-number'] - 1 ?>">Prev</a>
            <?php 
        } else {
            ?>
            <a>Prev</a>
            <?php
        }
    ?>
        
<div class='page-number'>
    <?php 
    for($counter = 1; $counter <= $pages; $counter++){
        echo '<a href="?page-number=' . $counter . '">' . $counter . '</a>';
    }
    ?>
</div>


   <?php 
    if(!isset($_GET['page-number'])){
        ?>
        <a href="?page-number=2">Next</a>
        <?php
    } else {
        if($_GET['page-number'] >= $pages){
            ?>
            <a>Next</a>
            <?php
    } else {
        ?>
            <a href='?page-number=<?php echo $_GET['page-number'] +1?>'>Next</a>
        <?php 
    }
        }
        ?>
    <a href='?page-number=<?php echo $pages ?>'>Last</a>
</div>


<!------------------Thêm---------------------------->

<h2>Thêm</h2>
<form method='POST' action='productline_add.php' enctype ='multipart/form-data'>
    <input type="text" name='productLine'placeholder='' required>
    <input type="text" name='textDescription'placeholder='' required>
    <input type="text" name='htmlDescription'placeholder='' required>
    <input type="file" name="image" id="image">
    <button type='submit' name='add'>Thêm</button>
</form>

<!------------------Form edit ẩn---------------------------->
<form method="POST" id="editForm" style="display: none" action="productline_update.php">
    <input type="hidden" name="productLine_edit" id="productLine_edit" placeholder="">
    <input type="text" name="textDescription_edit" id="textDescription_edit" placeholder="">
    <input type="text" name="htmlDescription_edit" id="htmlDescription_edit" placeholder="">
    
    <button type="submit" name="save" id='saveButton'>Lưu</button>
</form>

<?php 
$link->close();
?>
    

<script>
/*-------------hiện form-edit---------------------*/
var editButtons = document.getElementsByClassName("editButton");
for (var i = 0; i < editButtons.length; i++) {
    editButtons[i].addEventListener("click", function() {
        var row = this.closest("tr");
        var productLine = row.cells[0].innerText;
        var textDescription = row.cells[1].innerText;
        var htmlDescription = row.cells[2].innerText;

        // Gán giá trị vào các trường nhập liệu trong form chỉnh sửa
        document.querySelector("#productLine_edit").value = productLine;
        document.querySelector("#textDescription_edit").value = textDescription;
        document.querySelector("#htmlDescription_edit").value = htmlDescription;

        // Hiển thị form chỉnh sửa
        var editForm = document.getElementById("editForm");
        editForm.style.display = "block";
    });
}



$(document).ready(function() {
    $("#editForm").submit(function(event) {
        //event.preventDefault(); 

        // Lấy giá trị từ các trường trong form
        var productLine = $("#productLine_edit").val();
        var textDescription = $("#textDescription_edit").val();
        var htmlDescription = $("#htmlDescription_edit").val();

        // Gửi dữ liệu đến tệp PHP xử lý
        $.ajax({
            url: "productline_update.php",
            type: "POST",
            data: {
                productLine_edit: productLine,
                textDescription_edit: textDescription,
                htmlDescription_edit: htmlDescription,
                save: true //save với giá trị true để xác định là sự kiện lưu
            },
            success: function(response) {
                // Xử lý phản hồi từ tệp PHP (nếu cần)
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log("Lỗi: " + error);
            }
        });
    });
});

</script>