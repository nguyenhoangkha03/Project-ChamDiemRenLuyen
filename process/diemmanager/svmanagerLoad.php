<?php 
    require '../../database/sinhvienCls.php';
    require '../../database/bangdiemCls.php';
    $bangdiem = new Bangdiem();
    $sinhvien = new Sinhvien();

    $searchQuery = $_POST['searchQuery'];
    $idlop = $_POST['lop'];
    $hocky = $_POST['hocky'];
    $namhoc = $_POST['namhoc'];
    $result = $sinhvien->SinhvienSearchNameANDIDLop($searchQuery, $idlop);
    
    $count = 0;
    $output = '';

    if (count($result) > 0) {
        foreach ($result as $row) {
            $getcheck = $bangdiem->BangdiemGetbyIdSVAndNHAndHK($row->ID_SV, $namhoc, $hocky);
            $output .= '<tr>';
            $output .= '<td>' . ++$count . '</td>';
            $output .= '<td>' . $row->MASOSV . '</td>';
            $output .= '<td>' . $row->HOTEN . '</td>';
            $output .= '<td>' . $row->NGAYSINH . '</td>';
            $output .= '<td>' . ($row->GIOITINH == 1 ? "Nam" : "Nữ") . '</td>';
            $output .= '<td>' . 
                '<img width="100px" class="img-table" src="data:image/png;base64,' . ($row->HINHANH) . ' "/>'
            . '</td>';
            $output .= '<td>' . "Chưa hoàn thành" . '</td>';
            $output .= '<td class="operation-class" style="flex-direction: column; margin-top: 0;">' . 
                '<div class="update update-student" value="' . $row->ID_SV  . '">
                    <img class="icon-table" src="./images/update.png" alt="">
                    Sửa 
                </div>
                <div class="delete delete-student" value="' . $row->ID_SV  . '">
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