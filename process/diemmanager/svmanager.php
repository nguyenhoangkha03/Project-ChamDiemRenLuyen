<?php 
    if(!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    $idlop = $_GET['idlop'];
    $hocky = $_GET['hocky'];
    $namhoc = $_GET['namhoc'];
    require './database/bangdiemCls.php';
    $bangdiem = new Bangdiem();
    $list_sinhvien = $sinhvien->SinhVienGetByIdLop($idlop);
    $getl = $lop->LopGetByID($idlop);
    $count = 0;
?>
<div class="data" value="<?php echo $idlop . " " . $hocky . " " . $namhoc; ?>"></div>
<div class="address-profile" style="margin-bottom: 40px;">
    <div>QUẢN LÝ ĐIỂM CỦA SINH VIÊN LỚP: <?php echo $getl->TENLOP; ?></div>
    <div>Học kỳ: <?php echo $hocky; ?></div>
    <div>Năm học: <?php echo $namhoc; ?></div>
</div>
<div class="class-view">
            <div style="margin-bottom: 5px;">
                <div style="margin-right: 10px;" class="previous" onclick="window.location.href='index.php?request=managerScoreLop';">
                    <img width="30px" src="./images/back.png" alt="">
                    Trở về
                </div>
                <div>
                    <div style="margin-right: 0;">
                        Số lượng sinh viên : 
                        <span><?php echo count($list_sinhvien); ?></span>
                    </div>
                    <div style="print-score">
                        <img width="30px" src="./images/back.png" alt="">
                        In bản điểm
                    </div>
                </div>
            </div>
            <?php 
                if(count($list_sinhvien) > 0){
            ?>
                <table class="table-student">
                    <thead>
                    <th>STT</th>
                        <th>MSSV</th>
                        <th>Họ Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Giới Tính</th>
                        <th>Hình Ảnh</th>
                        <th>Tổng Điểm</th>
                        <th>Chấm Điểm</th>
                        <th>Xem</th>
                    </thead>
                    <tbody>
                <?php 
                    foreach($list_sinhvien as $sv){    
                        $getcheck = $bangdiem->BangdiemGetbyIdSVAndNHAndHK($sv->ID_SV, $namhoc, $hocky);           
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $sv->MASOSV; ?></td>
                        <td><?php echo $sv->HOTEN; ?></td>
                        <td><?php echo $sv->NGAYSINH; ?></td>
                        <td><?php echo $sv->GIOITINH == 1 ? "Nam" : "Nữ"; ?></td>
                        <td>
                            <img width="100px" height="120px" class="img-table" src='data:image/png;base64,<?php echo ($sv->HINHANH); ?>' />
                        </td>
                        <td><?php echo ($getcheck != null && $getcheck->TONGDIEMKHOA != null && $getcheck->TONGDIEMKHOA != 0) ? $getcheck->TONGDIEMKHOA : "Chưa hoàn thành"; ?></td>
                        <td class="bcs-operation" style="padding: 0;">
                        <?php 
                            if($getcheck != null){
                                if($getcheck->TONGDIEMSV == null && $getcheck->TONGDIEMLOP == null && $getcheck->TONGDIEMKHOA == null){
                            ?>
                                    <button onclick="alert('Sinh viên chưa thực hiện chấm!');" style="background-color: red;">Sinh viên chưa chấm</button>
                            <?php
                                }
                                if($getcheck->TONGDIEMSV != null && $getcheck->TONGDIEMLOP == null && $getcheck->TONGDIEMKHOA == null){
                            ?>
                                    <button value="<?php echo $sv->ID_SV . " " . $hocky . " " . $namhoc; ?>" class="bch-mark">Sinh viên đã hoàn thành</button>
                            <?php
                                }
                                if($getcheck->TONGDIEMSV != null && $getcheck->TONGDIEMLOP != null && $getcheck->TONGDIEMKHOA == null){
                            ?>
                                    <button value="<?php echo $sv->ID_SV . " " . $hocky . " " . $namhoc; ?>" class="bch-mark">Lớp đã chấm - Click chấm</button>
                            <?php
                                }
                                if($getcheck->TONGDIEMSV != null && $getcheck->TONGDIEMLOP != null && $getcheck->TONGDIEMKHOA != null){
                            ?>
                                    <button onclick="alert('Đã hoàn thành!');" style="background-color: green;">Đã hoàn thành</button>
                            <?php
                                }
                            }
                            else{
                        ?>
                                <button onclick="alert('Sinh viên chưa thực hiện chấm!');" style="background-color: red;">Sinh viên chưa chấm</button>
                        <?php
                            }
                        ?>
                        </td>
                        <td class="bcs-operation">
                            <button class="btn-scoreOfSV" value="<?php echo $sv->ID_SV . " " . $hocky . " " . $namhoc; ?>" style="background-color: lightseagreen;">Tất Cả Bảng Điểm</button>
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
                    <p class="title-not">
                        CHƯA CÓ SINH VIÊN TRONG LỚP NÀY
                    </p>
                    <div style="text-align: center;">
                        <button class="addnew-student" value="<?php echo $idlop; ?>">
                            Thêm Sinh Viên
                        </button>
                    </div>
            <?php
                }
            ?>
        </div>