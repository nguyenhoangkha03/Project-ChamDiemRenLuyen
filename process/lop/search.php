<?php 
    require '../../database/lopCls.php';
    $lop = new Lop();

    $searchQuery = $_POST['searchQuery'];
    $result = $lop->LopSearchName($searchQuery);
    
    $count = 0;
    $output = '';

    if (count($result) > 0) {
        foreach ($result as $row) {
            $output .= '<tr>';
            $output .= '<td>' . ++$count . '</td>';
            $output .= '<td>' . $row->TENLOP . '</td>';
            $output .= '<td>' . $row->KHOAHOC . '</td>';
            $output .= '<td>' . $row->SOLUONGSV . '</td>';
            $output .= '<td class="operation-class" style="margin: 0;">' . 
                '<div class="list-student" value="' . $row->ID_LOP  . '">
                    <img class="icon-table" src="./images/list.png" alt="">
                    Danh sách sinh viên 
                </div>
                <div class="update update-class" value="' . $row->ID_LOP  . '">
                    <img class="icon-table" src="./images/update.png" alt="">
                    Sửa 
                </div>
                <div class="delete delete-class" value="' . $row->ID_LOP  . '">
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