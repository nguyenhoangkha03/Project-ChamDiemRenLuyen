<?php 
    if(!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    require './database/bangdiemCls.php';
    $bangdiem = new Bangdiem();

    $idsv = $_GET['idsv'];
    $hocky = $_GET['hocky'];
    $namhoc = $_GET['namhoc'];
    $getsv = $sinhvien->SinhVienGetById($idsv);
    $getAllBD = $bangdiem->BangdiemGetbyIdSV($idsv);
    $count = 0;
?>
<div class="address-profile" style="margin-bottom: 40px;">
    <div>QUẢN LÝ TẤT CẢ BẢNG ĐIỂM CỦA SINH VIÊN <?php echo mb_strtoupper(" : " . $getsv->HOTEN); ?></div>
</div>
<div class="class-view">
            <div style="margin-bottom: 5px;">
                <div class="">
                    <div style="margin-right: 10px;" class="previous" onclick="window.location.href='index.php?request=managerScoreSV&idlop=<?php echo $getsv->ID_LOP; ?>&hocky=<?php echo $hocky; ?>&namhoc=<?php echo $namhoc; ?>';">
                            <img width="30px" src="./images/back.png" alt="">
                        Trở về
                    </div>
                </div>
                <div>
                    <div style="margin-right: 0;">
                        Số lượng bảng điểm : 
                        <span><?php echo count($getAllBD); ?></span>
                    </div>
                </div>
            </div>
            <?php 
                if(count($getAllBD) > 0){
            ?>
                <table class="table-class">
                    <thead>
                        <th>STT</th>
                        <th>Học Kỳ</th>
                        <th>Năm Học</th>
                        <th>Điểm Sinh Viên</th>
                        <th>Điểm Lớp</th>
                        <th>Điểm Khoa</th>
                        <th>Thao Tác</th>
                    </thead>
                    <tbody>
                <?php 
                    foreach($getAllBD as $bd){
                ?>
                        <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $bd->HOCKY; ?></td>
                        <td><?php echo $bd->NAMHOC; ?></td>
                        <td><?php echo $bd->TONGDIEMSV; ?></td>
                        <td><?php echo $bd->TONGDIEMLOP; ?></td>
                        <td><?php echo $bd->TONGDIEMKHOA; ?></td>
                        <td class="operation-class" style="margin: 0;">
                            <div class="watch-title" value="<?php echo $bd->ID_BD; ?>">
                                <img class="icon-table" src="./images/score.png" alt="">
                                Xem Chi Tiết
                            </div>
                            <div class="delete-score" value="<?php echo $bd->ID_BD; ?>">
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
                <div class="none-table">
                    SINH VIÊN KHÔNG CÓ BẢNG ĐIỂM NÀO
                </div>
            <?php
                }
            ?>
        </div>