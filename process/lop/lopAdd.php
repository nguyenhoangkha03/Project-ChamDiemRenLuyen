<?php 
    if(!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
?>
<div class="address-profile" style="margin-bottom: 20px;">
    <div>THÊM LỚP HỌC MỚI</div>
</div>
<div class="previous" onclick="window.location.href='index.php?request=lopView';">
    <img width="30px" src="./images/back.png" alt="">
    Trở về
</div>
<form class="form-classification" name="form-classification" method="POST" enctype="multipart/form-data"
        action="./process/lop/lopAct.php?reqact=addNew">
    <div class="class-add">
        <div class="add-left">
            <div class="title-class">THÔNG TIN LỚP HỌC</div>
            <hr>
            <div class="input-class">
                <div>Tên lớp</div>
                <input type="text" name="tenlop" placeholder="Nhập tên lớp" value="">
            </div>
            <div class="input-class">
                <div>Khóa học</div>
                <input type="text" name="khoahoc" placeholder="Nhập khóa học" value="">
            </div>
            <div class="input-class">
                <div>Số lượng sinh viên</div>
                <input type="text" name="soluongsinhvien" placeholder="Nhập số lượng sinh viên" value="">
            </div>         
        </div>
        <div class="add-right">
            <div class="button-save">
                <input type="submit" value="LƯU">
            </div>
            <div>
                <input type="reset" value="RESET">
            </div>
            <div>
                <button class="cancel-save">HỦY</button>
            </div>    
        </div>
    </div>
</form>
