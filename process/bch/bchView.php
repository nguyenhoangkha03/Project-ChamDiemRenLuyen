<?php 
    require './database/lopCls.php';
    require './database/sinhvienCls.php';
    $lop = new Lop();
    $sinhvien = new Sinhvien();
    $getAllBCH = $sinhvien->SinhVienGetByBCH();
?>
<div class="bch">
    <div class="bch-title">
        BAN CHẤP HÀNH CỦA KHOA
    </div>
    <div class="bch-add">THÊM BCH</div>
    <div class="bch-show">
    <?php 
        foreach($getAllBCH as $bch){
            $getlop = $lop->LopGetbyId($bch->ID_LOP);
    ?>
            <div class="bch-member">
                <img src="data:image/png;base64,<?php echo $bch->HINHANH; ?>" alt="">
                <div class="name-bch"><?php echo $bch->HOTEN; ?></div>
                <div class="bch-position-class">
                    <?php echo $bch->CHUCVU; ?> | <span><?php echo $bch->EMAIL; ?></span>
                </div>
                <div class="social-bch">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                </div>
                <button class="bch-contact">Liên Hệ Ngay</button>
                <div class="info-bch">
                    <div class="info-left">
                        <div>KHÓA</div>
                        <div><?php echo $getlop->KHOAHOC; ?></div>
                    </div>
                    <div class="info-mid">
                        <div>LỚP</div>
                        <div><?php echo $getlop->TENLOP; ?></div>
                    </div>
                    <div class="info-right">
                        <div>MSSV</div>
                        <div><?php echo $bch->MASOSV; ?></div>
                    </div>
                </div>
                <div class="control-bch">
                    <button value="<?php echo $bch->ID_SV; ?>">SỬA</button>
                    <button value="<?php echo $bch->ID_SV; ?>">XÓA</button>
                </div>
            </div>
    <?php
        }
    ?>
    </div>
</div>