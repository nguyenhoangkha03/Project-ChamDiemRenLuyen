<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logodoan.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <title>Đoàn Khoa</title>
</head>
<body>
    <div class="top">
        <div class="top-logo">
            <img class="logo" src="./images/logotruong.png" alt="">
            <img class="logo" src="./images/logodoan.png" alt="">
        </div>
        <div class="top-title">
            <div>ĐOÀN TRƯỜNG ĐẠI HỌC LUẬT TP. HCM</div>
            <div>BAN CHẤP HÀNH ĐOÀN KHOA LUẬT DÂN SỰ</div>
            <div>PHIẾU ĐÁNH GIÁ ĐIỂM RÈN LUYỆN TRỰC TUYẾN</div>
        </div>
    </div>
    <div style="display: flex; flex-direction: row; justify-content: center; background-color: white;">
        <div class="menu">
            <div class="list-class">
                <i class="fas fa-list"></i>
                <div class="name-menu">Lớp</div>
            </div>
            <div class="score-view">
                <i class="fas fa-file"></i>
                <div class="name-menu">Chấm Điểm Rèn Luyện</div>
            </div>
            <div class="bch-view">
                <i class="fas fa-star"></i>
                <div class="name-menu">Ban Chấp Hành</div>
            </div>
            <div class="vbhd-view">
                <i class="fas fa-camera"></i>
                <div class="name-menu">Văn Bản Hoạt Động</div>
            </div>
            <!-- <div class="menu-4">
                <i class="fas fa-book"></i>
                <div class="name-menu">Văn Bản Công Văn</div>
            </div> -->
            <div class="menu-5">
                <i class="fas fa-user"></i>
                <div class="name-menu">Tài khoản</div>
            </div>
        </div>
    </div>
    <div class="body">
        <!-- <div id="wordFrameContainer" style="overflow-x: hidden;">
            <iframe id="wordFrame" style="width: 100%; height: 800px; border: 1px solid #ccc;" src="" allow="autoplay"></iframe>
        </div> -->
        <?php 
            require './center.php';   
        ?>
    </div>
    <div class="bottom" style="height: 50px;">
        
    </div>
    <!-- script -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/jquery.js"></script>
    <script src="./js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/f940b3aea4.js" crossorigin="anonymous"></script>
</body>
</html>