<?php 
    //require './database/lopCls.php';
    // require './database/sinhvienCls.php';
    //$lop = new Lop();
    // $sinhvien = new Sinhvien();
    require './database/mangxahoiCls.php';
    $mxh = new MXH();
    $getAllBCH = $sinhvien->SinhVienGetByBCH();
?>
<div class="bch">
    <div class="address-profile" style="margin-bottom: 40px;">
        <div>BAN CHẤP HÀNH CỦA KHOA</div>
    </div>
    <?php 
        if(isset($_SESSION['ADMIN'])){
    ?>
            <div class="bch-add">THÊM BCH</div>
    <?php
        }
    ?>
    <div class="bch-show">
    <?php 
        foreach($getAllBCH as $bch){
            $getmxh = $mxh->MXHGetByIDSV($bch->ID_SV);
            $getlop = $lop->LopGetbyId($bch->ID_LOP);
    ?>
            <div class="bch-member">
                <img src="data:image/png;base64,<?php echo $bch->HINHANH; ?>" alt="">
                <div class="name-bch"><?php echo $bch->HOTEN; ?></div>
                <div class="bch-position-class">
                    <?php echo $bch->CHUCVU; ?> | <a href="mailto:<?php echo $bch->EMAIL; ?>"><span><?php echo $bch->EMAIL; ?></span></a>
                </div>
                <div class="social-bch">
                    <a target="_blank" href="<?php echo $getmxh == null ? 'https://www.facebook.com/' : ($getmxh->LINKFACEBOOK == null ? "https://www.facebook.com/" :  $getmxh->LINKFACEBOOK); ?>"><i class="fab fa-facebook"></i></a>           
                    <a target="_blank" href="<?php echo $getmxh == null ? 'https://www.instagram.com/' : ($getmxh->LINKINSTAGRAM == null ? "https://www.instagram.com/" :  $getmxh->LINKINSTAGRAM); ?>"><i class="fab fa-instagram"></i></a>
                </div>
                <a target="_blank" href="<?php echo $getmxh == null ? 'https://www.facebook.com/' : ($getmxh->LINKFACEBOOK == null ? "https://www.facebook.com/" :  $getmxh->LINKFACEBOOK); ?>"><button class="bch-contact">Liên Hệ Ngay</button></a>
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
                <?php 
                    if(isset($_SESSION['ADMIN'])){
                ?>
                        <div class="control-bch">
                        <button value="<?php echo $bch->ID_SV; ?>">SỬA</button>
                        <button value="<?php echo $bch->ID_SV; ?>">XÓA</button>
                </div>
                <?php
                    }
                ?>
            </div>
    <?php
        }
    ?>
    </div>
</div>