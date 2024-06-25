<?php 
    require '../../database/sinhvienCls.php';
    $sinhvien = new Sinhvien();

    $searchQuery = $_POST['searchQuery'];
    $result = $sinhvien->SinhvienSearchName($searchQuery);
    
    $count = 0;
    $output = '';

    if (count($result) > 0) {
        foreach ($result as $row) {
            $output .= '<tr>';
            $output .= '<td>' . ++$count . '</td>';
            $output .= '<td>' . $row->MASOSV . '</td>';
            $output .= '<td>' . $row->HOTEN . '</td>';
            $output .= '<td>' . $row->NGAYSINH . '</td>';
            $output .= '<td>' . ($row->GIOITINH == 1 ? "Nam" : "Nữ") . '</td>';
            $output .= '<td>' . $row->DIACHI . '</td>';
            $output .= '<td>' . $row->SDT . '</td>';
            $output .= '<td>' . $row->EMAIL . '</td>';
            $output .= '<td>' . 
                '<img width="100px" class="img-table" src="data:image/png;base64,' . ($row->HINHANH) . ' "/>'
            . '</td>';
            $output .= '<td class="operation-class">' . 
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