<?php 
    if(!isset($_SESSION['ADMIN'])){
        echo '<script>window.location.href = "index.php";</script>';
    }

    $a = './database/taikhoanCls.php';
    $b = '../../database/taikhoanCls.php';
    $c = '../database/taikhoanCls.php';
    if(file_exists($a)){
        $f = $a;
    }
    else if(file_exists($b)){
        $f = $b;
    }
    else{
        $f = $c;
    }
    require_once $f;
    $idtk = $_GET['id'];
    $taikhoan = new Taikhoan();
    $gettaikhoan = $taikhoan->TaiKhoanGetById($idtk);

    $getAllSV = $sinhvien->SinhvienGetAll();
    require './database/quyenCls.php';
    $quyen = new Quyen();
    $getAllQuyen = $quyen->QuyenGetAll();
?>
<div class="address-profile" style="margin-bottom: 20px;">
    <div>CẬP NHẬT TÀI KHOẢN</div>
</div>
<div class="previous" onclick="window.location.href='index.php?request=taikhoanView';">
    <img width="30px" src="./images/back.png" alt="">
    Trở về
</div>
<form class="form-classification" name="form-classification" method="POST" enctype="multipart/form-data"
        action="./process/taikhoan/taikhoanAct.php?reqact=update&idtk=<?php echo $idtk; ?>">
    <div class="class-add">
        <div class="add-left">
            <div class="title-class">CẬP NHẬT THÔNG TÀI KHOẢN : <?php echo $gettaikhoan->USERNAME; ?></div>
            <hr>
            <div class="input-class" style="margin-bottom: 20px;">
                <div>Chọn sinh viên</div>
                <select name="selectSV" class="mySelect" id="sinhvien" style="width: 169px;">
                    <?php 
                        foreach($getAllSV as $sv){
                            if($sv->ID_SV == $gettaikhoan->ID_SV){
                        ?>
                                <option selected value="<?php echo $sv->ID_SV; ?>"><?php echo $sv->HOTEN; ?></option>
                        <?php
                            }
                            else{
                        ?>
                                <option value="<?php echo $sv->ID_SV; ?>"><?php echo $sv->HOTEN; ?></option>
                        <?php
                            }
                        }
                    ?>                                 
                </select>
            </div>
            <div class="input-class" style="margin-bottom: 20px;">
                <div>Chọn quyền</div>
                <select name="selectQuyen" class="mySelect" id="quyen" style="width: 169px;">
                    <?php 
                        foreach($getAllQuyen as $q){
                            if($q->ID_QUYEN == $gettaikhoan->ID_QUYEN){
                        ?>
                                <option selected value="<?php echo $q->ID_QUYEN; ?>"><?php echo $q->TENQUYEN; ?></option>
                        <?php
                            }
                            else{
                        ?>
                                <option value="<?php echo $q->ID_QUYEN; ?>"><?php echo $q->TENQUYEN; ?></option>
                        <?php
                            }
                        }
                    ?>                                 
                </select>
            </div>
            <div class="input-class">
                <div>Username</div>
                <input type="text" name="username" placeholder="Nhập username" value="<?php echo $gettaikhoan->USERNAME; ?>">
            </div>
            <div class="input-class">
                <div>Password</div>
                <input type="text" name="password" placeholder="Nhập password" value="<?php echo $gettaikhoan->PASSWORD; ?>">
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
                <button class="cancel-save-taikhoan">HỦY</button>
            </div>    
        </div>
    </div>
</form>
