<?php 
    if(!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    $a = './database/lopCls.php';
    $b = '../../database/lopCls.php';
    $c = '../database/lopCls.php';
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
    $idlop = $_GET['id'];
    $lop = new Lop();
    $getlop = $lop->LopGetbyId($idlop);
?>
<form class="form-classification" name="form-classification" method="POST" enctype="multipart/form-data"
        action="./process/lop/lopAct.php?reqact=update&idlop=<?php echo $idlop; ?>">
    <div class="class-add">
        <div class="add-left">
            <div class="title-class">CẬP NHẬT THÔNG TIN LỚP : <?php echo $getlop->TENLOP . " - KHÓA : " . $getlop->KHOAHOC; ?></div>
            <hr>
            <div class="input-class">
                <div>Tên lớp</div>
                <input type="text" name="tenlop" placeholder="Nhập tên lớp" value="<?php echo $getlop->TENLOP; ?>">
            </div>
            <div class="input-class">
                <div>Khóa học</div>
                <input type="text" name="khoahoc" placeholder="Nhập khóa học" value="<?php echo $getlop->KHOAHOC; ?>">
            </div>
            <div class="input-class">
                <div>Số lượng sinh viên</div>
                <input type="text" name="soluongsinhvien" placeholder="Nhập số lượng sinh viên" value="<?php echo $getlop->SOLUONGSV; ?>">
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
