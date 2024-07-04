<?php 
    if(!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH']) && !isset($_SESSION['STUDENT'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
?>
<div class="address-profile">
    <div>Tài Khoản</div>
    <!-- <div class="profile-address">
        <div><a href="index.php">Home</a></div>
        <img style="width: 8px;" src="./images/icon/next-address.png" alt="">
        <div style="cursor: default;" class="next-address">Tài khoản</div>
    </div> -->
</div>
<!-- <form class="form-classification" id="form-update" name="form-classification" method="post" enctype="multipart/form-data" 
    action="./PageManager/process/khachhang/khachhangAct.php?reqact=profileUpdate"> -->
    <div class="profile-account">
        <div class="left-profile">
            <div>THÔNG TIN SINH VIÊN</div>
            <hr>
            <div class="input-profile">
                <div>MSSV</div>
                <input type="text" readonly name="mssv" value="<?php echo $getsinhvien->MASOSV; ?>">
            </div>
            <div class="input-profile">
                <div>Họ Tên</div>
                <input type="text" readonly name="hoten" value="<?php echo $getsinhvien->HOTEN; ?>">
            </div>
            <div class="input-profile">
                <div>Ngày sinh</div>
                <input readonly type="date" name="ngaysinh" value="<?php echo $getsinhvien->NGAYSINH; ?>">
            </div>
            <div class="input-profile">
                <div>Giới tính</div>
                <!-- <div class="radio-sex">
                    <input type="radio" checked name="gioitinh" value="nam" id="nam">
                    <label for="nam">Nam</label>
                    <input type="radio" name="gioitinh"  value="nu" id="nu">
                    <label for="nu">Nữ</label>
                </div> -->
                <input readonly type="text" name="ngaysinh" value="<?php echo $getsinhvien->GIOITINH == 1 ? "Nam" : "Nữ"; ?>">
            </div>
            <div class="input-profile">
                <div>Địa chỉ</div>
                <input type="text" name="diachi" value="<?php echo $getsinhvien->DIACHI; ?>">
            </div>
            <div class="input-profile">
                <div>Số điện thoại</div>
                <input type="text" readonly name="sdt" value="<?php echo $getsinhvien->SDT; ?>">
            </div>
            <div class="input-profile">
                <div>Email</div>
                <input type="email" readonly name="email" value="<?php echo $getsinhvien->EMAIL; ?>">
            </div>
            <div class="input-profile">
                <div>Lớp</div>
                <input type="email" readonly name="email" value="<?php echo $getlop->TENLOP; ?>">
            </div>
            <?php 
                if(isset($_SESSION['ADMIN'])){
            ?>
                <div class="input-profile">
                    <div>Chức vụ</div>
                    <input type="email" readonly name="email" value="<?php echo $getsinhvien->CHUCVU; ?>">
                </div>
            <?php
                }
                else if(isset($_SESSION['BCH'])){
            ?>
                <div class="input-profile">
                    <div>Chức vụ</div>
                    <input type="email" readonly name="email" value="<?php echo $getsinhvien->CHUCVU; ?>">
                </div>
            <?php
                }
                else{
                }
            ?>
            
            
            <hr style="margin-top: 10px; width: 98%;">
            <div class="button-update">
                <!-- <input type="submit" value="CẬP NHẬT"> -->
                <input class="changePassword" type="button" value="ĐỔI MẬT KHẨU">
                <input class="logout" type="button" value="ĐĂNG XUẤT">
            </div>
        </div>
        <div class="right-profile">
            <div>ẢNH ĐẠI DIỆN</div>
            <hr>
            <div class="avatar">
                <div class="image-avatar">
                    <!-- <img src="./images/logodoan.png" alt=""> -->
                    <img src="data:image/png;base64,<?php echo $getsinhvien->HINHANH; ?>" alt="">
                </div>
                <!-- <div class="file-avatar">
                    <label for="file-upload">Chọn Ảnh</label>
                    <input type="file" name="fileInput" id="file-upload">
                </div>-->
                <div class="rule-image">
                    <!-- Dụng lượng file tối đa 1 MB
                    <br>
                    Định dạng:.JPEG, .PNG -->
                </div> 
            </div>
        </div>
    </div>
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="change-title">
                <div>Đổi Mật Khẩu</div>
                <div>&times;</div>
            </div>
            <div class="change-body">
                <form class="form-changePass" action="./process/taikhoan/taikhoanAct.php?reqact=changePassword" method="POST">
                    <div>
                        <label for="passOld">Mật khẩu cũ</label>
                    </div>
                    <input class="passOld" required placeholder="Nhập mật khẩu cũ" id="passOld" name="passOld" type="text">
                    <div>
                        <label for="passNew">Mật khẩu mới</label>
                    </div>
                    <input class="passNew" required placeholder="Nhập mật khẩu mới" id="passNew" name="passNew" type="password">
                    <div>
                        <label for="passConfirm">Xác nhận mật khẩu</label>
                    </div>
                    <input class="passConfirm" required placeholder="Xác nhận lại mật khẩu" id="passConfirm" name="passConfirm" type="password">
                    <div style="margin-top: 20px; display: flex; justify-content: end;">
                        <input type="submit" value="Lưu">
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- </form> -->