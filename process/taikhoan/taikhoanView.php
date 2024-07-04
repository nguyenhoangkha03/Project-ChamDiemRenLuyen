<?php 
    // require './database/lopCls.php';
    // $lop = new Lop();
    if(!isset($_SESSION['ADMIN'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    require './database/quyenCls.php';
    $quyen = new Quyen();
    $list_taikhoan = $taikhoan->TaiKhoanGetAll();
    $getAllSV = $sinhvien->SinhvienGetAll();
    $count = 0;
?>
<div class="address-profile" style="margin-bottom: 20px;">
    <div>QUẢN LÝ TÀI KHOẢN</div>
    <!-- <div class="profile-address">
        <div><a href="index.php">Home</a></div>
        <img style="width: 8px;" src="./images/icon/next-address.png" alt="">
        <div style="cursor: default;" class="next-address">Tài khoản</div>
    </div> -->
</div>
<div class="class-view">
    <div>
        <div class="addnew-taikhoan">
            Cấp tài khoản
        </div>
        <div>
            <div>
                Số lượng tài khoản : 
                <span><?php echo count($list_taikhoan); ?></span>
            </div>
            <div>
                Chọn sinh viên để tìm : 
                <!-- <input class="search-class" type="text"> -->
                <select name="selectSV" class="mySelect search-taikhoan" id="sinhvien" style="width: 190px;">
                    <?php 
                        foreach($getAllSV as $sv){
                    ?>
                            <option value="<?php echo $sv->ID_SV; ?>"><?php echo $sv->HOTEN; ?></option>
                    <?php
                        }
                    ?>                                 
                </select>
            </div>
        </div>
    </div>
    <?php 
        if(count($list_taikhoan) > 0){
    ?>
        <table class="table-class">
            <thead>
                <th>STT</th>
                <th>Username</th>
                <th>Password</th>
                <th>Ngày Cấp</th>
                <th>Trạng Thái</th>
                <th>Sinh Viên</th>
                <th>Quyền</th>
                <th>Thao Tác</th>
            </thead>
            <tbody>
        <?php 
            foreach($list_taikhoan as $tk){
                $getquyen = $quyen->QuyenGetbyId($tk->ID_QUYEN);
        ?>
                <tr>
                <td><?php echo ++$count; ?></td>
                <td><?php echo $tk->USERNAME; ?></td>
                <td><?php echo $tk->PASSWORD; ?></td>
                <td><?php echo $tk->NGAYCAP; ?></td>
                <td><?php echo $tk->TRANGTHAI == 1 ? "Action" : "Lock"; ?></td>
                <td>
                    <?php 
                        echo $getsinhvien->MASOSV . "-" . $getsinhvien->HOTEN . "-" . $getlop->TENLOP;
                    ?>
                </td>
                <td>
                    <?php 
                        echo $getquyen->TENQUYEN;
                    ?>
                </td>
                <td style="display: flex; align-items: center;">
                    <div class="update update-taikhoan" value="<?php echo $tk->ID_TK; ?>">
                        <img class="icon-table" src="./images/update.png" alt="">
                        Sửa 
                    </div>
                    <div class="delete delete-taikhoan" value="<?php echo $tk->ID_TK; ?>">
                        <img class="icon-table" src="./images/delete.png" alt="">
                        Delete 
                    </div>
                </td>
            </tr>
        <?php
            }
        ?>
            </tbody>
        </table>
    <?php
        }
        else{
    ?>

    <?php
        }
    ?>
</div>