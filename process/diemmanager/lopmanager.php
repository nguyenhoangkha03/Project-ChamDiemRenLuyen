<?php 
    if(!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    require './database/bangdiemCls.php';
    $list_lop = $lop->LopGetAll();
    $count = 0;
    $bangdiem = new Bangdiem();
    $getAllNHHK = $bangdiem->BangdiemAllNHHK();
?>
<div class="address-profile" style="margin-bottom: 40px;">
    <div>QUẢN LÝ ĐIỂM RÈN LUYỆN</div>
</div>
<div class="class-view">
            <div style="margin-bottom: 5px;">
                <div class="choose-NHHK"> Chọn:
                    <select class="select-NHHK" name="" id="">
                        <option selected disabled value="default" style="text-align: center;">Chọn Học Kỳ</option>
                    <?php 
                        foreach($getAllNHHK as $nhhk){
                    ?>
                            <option value="<?php echo $nhhk->HOCKY . " " . $nhhk->NAMHOC; ?>"><?php echo "Học kỳ: " . $nhhk->HOCKY . " - Năm học: " . $nhhk->NAMHOC; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <div>
                        Số lượng lớp : 
                        <span><?php echo count($list_lop); ?></span>
                    </div>
                    <div>
                        Nhập tên lớp : 
                        <input class="search-class" type="text">
                    </div>
                </div>
            </div>
            <?php 
                if(count($list_lop) > 0){
            ?>
                <table class="table-class">
                    <thead>
                        <th>STT</th>
                        <th>Tên Lớp</th>
                        <th>Khóa</th>
                        <th>Số Lượng Sinh Viên</th>
                        <th>Đã Hoàn Thành</th>
                        <th>Thao Tác</th>
                    </thead>
                    <tbody>
                <?php 
                    foreach($list_lop as $l){
                        $countSV = 0;
                        $getsvbylop = $sinhvien->SinhVienGetByIdLop($l->ID_LOP);
                ?>
                        <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $l->TENLOP; ?></td>
                        <td><?php echo $l->KHOAHOC; ?></td>
                        <td><?php echo count($getsvbylop); ?></td>
                        <td></td>
                        <td class="operation-class">
                            <div class="list-student-score" value="<?php echo $l->ID_LOP . " default"; ?>">
                                <img class="icon-table" src="./images/list.png" alt="">
                                Chấm Điểm Cho Lớp
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