<?php
$page='home'; 
//include 'navbar.php';
include 'header.php';
require 'config/config.php';
?>
<link rel="stylesheet" href="css/index.css">
<div class='body'>


<div class="container ">
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist" style='padding:20px;'>
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tất cả khóa học</button>
    <!--<button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>-->
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class='row my-3'>

        <div class="col-md-3" >
            <div class='img-container'>
                <img src="https://cdn.vectorstock.com/i/1000x1000/80/31/physics-background-with-formulas-and-symbols-vector-46698031.webp" alt="" ><br><hr>
                <h4>Vật Lý</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class='img-container'>
                <img src="https://cdn.vectorstock.com/i/1000x1000/02/52/chemistry-school-subject-icon-education-vector-32720252.webp" alt="" ><br><hr>
                <h4>Hóa học</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class='img-container'>
                <img src="https://cdn.vectorstock.com/i/1000x1000/04/28/mathematics-vector-1410428.webp" alt="" ><br><hr>
                <h4>Toán học</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class='img-container'>
                <img src="data:image/png;base64,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" alt="" ><br><hr>
                <h4>Tiếng Anh</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class='img-container'>
                <img src="https://play-lh.googleusercontent.com/HjPGFF1UCY1TKwseyv2hutlcTa3Zwxm21oPwPDsHtfKLl8a-ovf77X1KnXcivYMNydg=w240-h480-rw" alt="" ><br><hr>
                <h4>Sinh Học</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class='img-container'>
                <img src="https://cdn.vectorstock.com/i/1000x1000/15/59/literature-school-subject-study-ancient-vector-44531559.webp" alt="" ><br><hr>
                <h4>Ngữ Văn</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class='img-container'>
                <img src="https://cdn.vectorstock.com/i/1000x1000/99/38/history-vector-4489938.webp" alt="" ><br><hr>
                <h4>Lịch Sử</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class='img-container'>
                <img src="https://cdn.vectorstock.com/i/1000x1000/56/19/geography-vector-5855619.webp" alt="" ><br><hr>
                <h4>Địa Lý</h4>
            </div>
        </div>

    </div>

  </div>















  <!--<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>-->


</div>








<?php
    include 'footer.php';
?>


