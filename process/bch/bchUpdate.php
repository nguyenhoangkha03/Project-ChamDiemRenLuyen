<?php 
    if(!isset($_SESSION['ADMIN'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    //require './database/sinhvienCls.php';
    //require './database/lopCls.php';
    require './database/mangxahoiCls.php';
    $mxh = new MXH();
    //$lop = new Lop();
    $getAllLop = $lop->LopGetAll();
    //$sinhvien = new Sinhvien();
    $idsv = $_GET['idsv'];
    $getsv = $sinhvien->SinhVienGetById($idsv);
    $getlop = $lop->LopGetbyId($getsv->ID_LOP);
    $getmxh = $mxh->MXHGetByIDSV($idsv);
?>
<form class="form-classification" name="form-classification" method="POST" enctype="multipart/form-data"
        action="./process/sinhvien/sinhvienAct.php?reqact=updateBCH&idsv=<?php echo $idsv; ?>">
    <div class="class-add">
        <div class="add-left">
            <div class="title-class">CẬP NHẬT THÔNG TIN BAN CHẤP HÀNH : <?php echo $getsv->HOTEN; ?></div>
            <hr>
            <div class="input-class" style="margin-bottom: 25px;">
                <div>Chọn Lớp</div>
                <select class="mySelect" name="lop" id="lop" style="width: 170px;">
                    <?php 
                        foreach($getAllLop as $l){
                                if($l->ID_LOP == $getlop->ID_LOP){
                            ?>
                                    <option selected value="<?php echo $l->ID_LOP; ?>"><?php echo $l->TENLOP; ?></option>
                            <?php
                                }
                                else{
                            ?>
                                    <option value="<?php echo $l->ID_LOP; ?>"><?php echo $l->TENLOP; ?></option>
                            <?php
                                }
                        }
                    ?>
                </select>
            </div>
            <div class="input-class">
                <div>MSSV</div>
                <input type="text" name="mssv" placeholder="Nhập mã số sinh viên" value="<?php echo $getsv->MASOSV; ?>">
            </div>
            <div class="input-class">
                <div>Họ Tên</div>
                <input type="text" name="hoten" placeholder="Nhập họ tên" value="<?php echo $getsv->HOTEN; ?>">
            </div>
            <div class="input-class">
                <div>Ngày Sinh</div>
                <input type="date" name="ngaysinh" value="<?php echo $getsv->NGAYSINH; ?>">
            </div>    
            <div class="input-class" style="margin-bottom: 20px;">
                <div>Giới Tính</div>
                <div style="display: flex; align-items: center;">        
                    <?php 
                        if($getsv->GIOITINH == 1){
                    ?>
                            <input id="nam" checked type="radio" name="gioitinh" value="nam">
                            <label for="nam">Nam</label>
                            <input id="nu" type="radio" name="gioitinh" value="nu">
                            <label for="nu">Nữ</label>
                    <?php
                        }
                        else{
                    ?>
                            <input id="nam"  type="radio" name="gioitinh" value="nam">
                            <label for="nam">Nam</label>
                            <input id="nu" checked type="radio" name="gioitinh" value="nu">
                            <label for="nu">Nữ</label>
                    <?php
                        }
                    ?>          
                    
                </div>
            </div>  
            <div class="input-class">
                <div>Địa Chỉ</div>
                <input type="text" name="diachi" placeholder="Nhập địa chỉ" value="<?php echo $getsv->DIACHI; ?>">
            </div>
            <div class="input-class">
                <div>Số Điện Thoại</div>
                <input type="text" name="sdt" placeholder="Nhập số điện thoại" value="<?php echo $getsv->SDT; ?>">
            </div> 
            <div class="input-class">
                <div>Email</div>
                <input type="text" name="email" placeholder="Nhập Email" value="<?php echo $getsv->EMAIL; ?>">
            </div>  
            <div class="input-class">
                <div>Chức Vụ</div>
                <input type="text" name="chucvu" placeholder="Nhập chức vụ" value="<?php echo $getsv->CHUCVU; ?>">
            </div>  
            <div class="input-class">
                <div>Hình Ảnh</div>
                <label for="file-upload" class="custom-file-input">
                    Choose File
                    <input type="file" id="file-upload" name="file-upload">
                </label>
                <div class="file-name" id="file-name-display"></div>
                <img width="100px" src="data:image/png;base64,<?php echo $getsv->HINHANH; ?>" alt="">
            </div>  
            <hr>   
            <div class="title-class" style="margin-top: 20px;">THÔNG TIN MẠNG XÃ HỘI (NẾU CÓ)</div>
            <div class="input-class" style="margin-top: 20px;">
                <div>Link Facebook</div>
                <input type="text" name="facebook" placeholder="Nhập link Facebook" value="<?php echo $getmxh->LINKFACEBOOK; ?>">
            </div>
            <div class="input-class">
                <div>Link Instagram</div>
                <input type="text" name="instagram" placeholder="Nhập link Instagram" value="<?php echo $getmxh->LINKINSTAGRAM; ?>">
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
                <button class="cancel-save-student" value="<?php echo $getsv->ID_LOP; ?>">HỦY</button>
            </div>    
        </div>
    </div>
</form>
