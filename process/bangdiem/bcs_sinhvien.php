<?php 
    $idlop = $_GET['idlop'];
    $list_sinhvien = $sinhvien->SinhVienGetByIdLop($idlop);
    $count = 0;

    require './database/bangdiemCls.php';
    $bangdiem = new Bangdiem();
    $getcheckboth = $bangdiem->BangdiemGetbyCheckBoth(1,1);
?>
<div class="address-profile" style="margin-bottom: 40px;">
    <div>BAN CÁN SỰ CHẤM ĐIỂM RÈN LUYỆN CHO LỚP : <?php echo $getlop->TENLOP; ?></div>
</div>
<div class="class-view">
            <div style="margin-bottom: 10px;">
                <div>

                </div>
                <div>
                    <div style="margin-right: 0;">
                        Số lượng sinh viên : 
                        <span><?php echo count($list_sinhvien); ?></span>
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
                        <th>Điểm RL</th>
                    </thead>
                    <tbody>
                <?php 
                    foreach($list_sinhvien as $sv){   
                        if($getcheckboth != null){
                            $getchecksv = $bangdiem->BangdiemGetbyIdSVAndNHAndHK($sv->ID_SV, $getcheckboth->NAMHOC, $getcheckboth->HOCKY);                  
                        }
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
                        <td class="bcs-operation">
                        <?php 
                            if($getcheckboth == null){
                        ?>
                                <button>Chưa mở bảng điểm học kỳ này</button>
                        <?php
                            }
                            else{
                                if($getchecksv == null){
                            ?>
                                    <button style="background-color: red;">Sinh viên chưa hoàn thành</button>
                            <?php    
                                }
                                else{
                                    if($getchecksv->TONGDIEMLOP == null){
                                ?>
                                        <button class="bcs-mark" value="<?php echo $sv->ID_SV; ?>">Sinh viên đã hoàn thành - Click để chấm điểm</button>
                                <?php
                                    }else{
                                ?>
                                        <button style="background-color: green;">Ban cán sự đã chấm xong</button>
                                <?php
                                    }
                                }
                            }
                        ?>
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