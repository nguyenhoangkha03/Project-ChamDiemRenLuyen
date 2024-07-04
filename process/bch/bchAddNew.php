<?php 
    if(!isset($_SESSION['ADMIN'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    //require './database/sinhvienCls.php';
    //require './database/lopCls.php';
    //$lop = new Lop();
    $getAllLop = $lop->LopGetAll();
    //$sinhvien = new Sinhvien();
?>
<form class="form-classification" name="form-classification" method="POST" enctype="multipart/form-data"
        action="./process/sinhvien/sinhvienAct.php?reqact=addNewBCH">
    <div class="class-add">
        <div class="add-left">
            <div class="title-class">THÔNG TIN BAN CHẤP HÀNH</div>
            <hr>
            <div class="input-class" style="margin-bottom: 25px;">
                <div>Chọn Lớp</div>
                <select class="mySelect" name="lop" id="lop" style="width: 170px;">
                    <?php 
                        foreach($getAllLop as $l){
                            ?>
                                <option value="<?php echo $l->ID_LOP; ?>"><?php echo $l->TENLOP; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <div class="input-class">
                <div>MSSV</div>
                <input type="text" name="mssv" placeholder="Nhập mã số sinh viên" value="">
            </div>
            <div class="input-class">
                <div>Họ Tên</div>
                <input type="text" name="hoten" placeholder="Nhập họ tên" value="">
            </div>
            <div class="input-class">
                <div>Ngày Sinh</div>
                <input type="date" name="ngaysinh" value="">
            </div>    
            <div class="input-class" style="margin-bottom: 20px;">
                <div>Giới Tính</div>
                <div style="display: flex; align-items: center;">                  
                    <input id="nam" checked type="radio" name="gioitinh" value="nam">
                    <label for="nam">Nam</label>
                    <input id="nu" type="radio" name="gioitinh" value="nu">
                    <label for="nu">Nữ</label>
                </div>
            </div>  
            <div class="input-class">
                <div>Địa Chỉ</div>
                <input type="text" name="diachi" placeholder="Nhập địa chỉ" value="">
            </div>
            <div class="input-class">
                <div>Số Điện Thoại</div>
                <input type="text" name="sdt" placeholder="Nhập số điện thoại" value="">
            </div> 
            <div class="input-class">
                <div>Email</div>
                <input type="email" name="email" placeholder="Nhập Email" value="">
            </div>  
            <div class="input-class">
                <div>Chức Vụ</div>
                <input type="text" name="chucvu" placeholder="Nhập chức vụ" value="">
            </div>  
            <div class="input-class">
                <div>Hình Ảnh</div>
                <label for="file-upload" class="custom-file-input">
                    Choose File
                    <input type="file" id="file-upload" name="file-upload">
                </label>
                <div class="file-name" id="file-name-display"></div>
            </div>    
            <hr>   
            <div class="title-class" style="margin-top: 20px;">THÔNG TIN MẠNG XÃ HỘI (NẾU CÓ)</div>
            <div class="input-class" style="margin-top: 20px;">
                <div>Link Facebook</div>
                <input type="text" name="facebook" placeholder="Nhập link Facebook" value="">
            </div>
            <div class="input-class">
                <div>Link Instagram</div>
                <input type="text" name="instagram" placeholder="Nhập link Instagram" value="">
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
                <button class="cancel-save-bch">HỦY</button>
            </div>    
        </div>
    </div>
</form>
