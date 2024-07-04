<?php 
    require '../../database/taikhoanCls.php';
    require '../../database/sinhvienCls.php';
    require '../../database/lopCls.php';
    require '../../database/quyenCls.php';
    $taikhoan = new Taikhoan();
    $sinhvien = new Sinhvien();
    $lop = new Lop();
    $quyen = new Quyen();

    $searchQuery = $_POST['searchQuery'];
    $result = $taikhoan->TaiKhoanGetByIdSV($searchQuery);

    $getsinhvien = $sinhvien->SinhVienGetById($searchQuery);
    $getlop = $lop->LopGetbyId($getsinhvien->ID_LOP);
    
    $count = 0;
    $output = '';

    if (count($result) > 0) {
        foreach ($result as $row) {
            $getquyen = $quyen->QuyenGetbyId($row->ID_QUYEN);
            $output .= '<tr>';
            $output .= '<td>' . ++$count . '</td>';
            $output .= '<td>' . $row->USERNAME . '</td>';
            $output .= '<td>' . $row->PASSWORD . '</td>';
            $output .= '<td>' . $row->NGAYCAP . '</td>';
            $output .= '<td>' . ($row->TRANGTHAI == 1 ? "Action" : "Lock") . '</td>';
            $output .= '<td>' . $getsinhvien->MASOSV . "-" . $getsinhvien->HOTEN . "-" . $getlop->TENLOP  . '</td>';
            $output .= '<td>' . $getquyen->TENQUYEN . '</td>';
            $output .= '<td style="display:flex; flex-direction: row;">' . 
                '
                <div class="update update-taikhoan" value="' . $row->ID_TK  . '">
                    <img class="icon-table" src="./images/update.png" alt="">
                    Sửa 
                </div>
                <div class="delete delete-taikhoan" value="' . $row->ID_TK  . '">
                    <img class="icon-table" src="./images/delete.png" alt="">
                    Delete 
                </div>'
            . '</td>';
            $output .= '</tr>';
        }
    } else {
        $output .= '<tr><td colspan="2">Không tìm thấy kết quả</td></tr>';
    }

    echo $output;
?>