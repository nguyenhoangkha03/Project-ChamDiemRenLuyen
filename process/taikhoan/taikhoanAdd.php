<?php 
    if(!isset($_SESSION['ADMIN'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    $getAllSV = $sinhvien->SinhvienGetAll();
    require './database/quyenCls.php';
    $quyen = new Quyen();
    $getAllQuyen = $quyen->QuyenGetAll();
?>
<form class="form-classification" name="form-classification" method="POST" enctype="multipart/form-data"
        action="./process/taikhoan/taikhoanAct.php?reqact=addNew">
    <div class="class-add">
        <div class="add-left">
            <div class="title-class">THÔNG TIN TÀI KHOẢN</div>
            <hr>
            <div class="input-class" style="margin-bottom: 20px;">
                <div>Chọn sinh viên</div>
                <select name="selectSV" class="mySelect" id="sinhvien" style="width: 200px;">
                    <?php 
                        foreach($getAllSV as $sv){
                            $lopbysv = $lop->LopGetbyId($sv->ID_LOP);
                    ?>
                            <option value="<?php echo $sv->ID_SV; ?>"><?php echo $sv->HOTEN . " - " . $lopbysv->TENLOP; ?></option>
                    <?php
                        }
                    ?>                                 
                </select>
            </div>
            <div class="input-class" style="margin-bottom: 20px;">
                <div>Chọn quyền</div>
                <select name="selectQuyen" class="mySelect" id="quyen" style="width: 200px;">
                    <?php 
                        foreach($getAllQuyen as $q){
                    ?>
                            <option value="<?php echo $q->ID_QUYEN; ?>"><?php echo $q->TENQUYEN; ?></option>
                    <?php
                        }
                    ?>                                 
                </select>
            </div>
            <div class="input-class">
                <div>Username</div>
                <input type="text" name="username" placeholder="Nhập username" value="">
            </div>
            <div class="input-class">
                <div>Password</div>
                <input type="text" name="password" placeholder="Nhập password" value="">
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
