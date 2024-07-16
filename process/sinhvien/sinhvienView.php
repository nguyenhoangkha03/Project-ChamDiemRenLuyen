<?php 
    $idlop = $_GET['idlop'];
    $list_sinhvien = $sinhvien->SinhVienGetByIdLop($idlop);
    $count = 0;
?>
<div class="address-profile" style="margin-bottom: 40px;">
    <div>QUẢN LÝ SINH VIÊN</div>
</div>
<div class="data-sv" value="<?php echo $idlop; ?>"></div>
<div class="class-view">
            <div>
                <div class="addnew-student" value="<?php echo $idlop; ?>">
                    Thêm Sinh Viên
                </div>
                <div>
                    <div>
                        Số lượng sinh viên : 
                        <span><?php echo count($list_sinhvien); ?></span>
                    </div>
                    <div>
                        Nhập tên sinh viên : 
                        <input class="search-student" type="text">
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
                        <th>Địa Chỉ</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Hình Ảnh</th>
                        <th>Thao Tác</th>
                    </thead>
                    <tbody>
                <?php 
                    foreach($list_sinhvien as $sv){                     
                ?>
                    <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $sv->MASOSV; ?></td>
                        <td><?php echo $sv->HOTEN; ?></td>
                        <td><?php echo $sv->NGAYSINH; ?></td>
                        <td><?php echo $sv->GIOITINH == 1 ? "Nam" : "Nữ"; ?></td>
                        <td><?php echo $sv->DIACHI; ?></td>
                        <td><?php echo $sv->SDT; ?></td>
                        <td><?php echo $sv->EMAIL; ?></td>
                        <td>
                            <img width="100px" height="120px" class="img-table" src='data:image/png;base64,<?php echo ($sv->HINHANH); ?>' />
                        </td>
                        <td class="operation-class" style="flex-direction: column; margin-top: 0;">
                            <div style="margin-top: 10px;" class="update update-student" value="<?php echo $sv->ID_SV; ?>">
                                <img class="icon-table" src="./images/update.png" alt="">
                                Sửa 
                            </div>
                            <div style="margin-top: 10px;" class="delete delete-student" value="<?php echo $sv->ID_SV; ?>">
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