<?php 
    if(!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])){
        echo '<script>window.location.href = "index.php";</script>';
    }
    // require './database/lopCls.php';
    // $lop = new Lop();
    $list_lop = $lop->LopGetAll();
    $count = 0;

?>
<div class="class-view">
            <div>
                <div class="addnew-class">
                    Thêm lớp
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
                        <th>Thao Tác</th>
                    </thead>
                    <tbody>
                <?php 
                    foreach($list_lop as $l){
                        $getsvbylop = $sinhvien->SinhVienGetByIdLop($l->ID_LOP);
                ?>
                        <tr>
                        <td><?php echo ++$count; ?></td>
                        <td><?php echo $l->TENLOP; ?></td>
                        <td><?php echo $l->KHOAHOC; ?></td>
                        <td><?php echo count($getsvbylop); ?></td>
                        <td class="operation-class">
                            <div class="list-student" value="<?php echo $l->ID_LOP; ?>">
                                <img class="icon-table" src="./images/list.png" alt="">
                                Danh sách sinh viên 
                            </div>
                            <div class="update update-class" value="<?php echo $l->ID_LOP; ?>">
                                <img class="icon-table" src="./images/update.png" alt="">
                                Sửa 
                            </div>
                            <div class="delete delete-class" value="<?php echo $l->ID_LOP; ?>">
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

            <?php
                }
            ?>
        </div>