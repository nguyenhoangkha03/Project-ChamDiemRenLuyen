<?php 
    require '../../database/bangdiemCls.php';
    require '../../database/lopCls.php';
    require '../../database/sinhvienCls.php';
    $hocky = $_POST['hocky'];
    $namhoc = $_POST['namhoc'];
    $bangdiem = new Bangdiem();
    $lop = new Lop();
    $sinhvien = new Sinhvien();
    
    $getAllBDCount = $bangdiem->BangdiemGetbyNHAndHKOrderbyLOP($hocky,$namhoc);
    $getAllLop = $lop->LopGetAll();

    $count = 0;
    $output = '';

    if (count($getAllLop) > 0) {
        foreach ($getAllLop as $row) {
            $countHT = 0;
            $getsvbylop = $sinhvien->SinhVienGetByIdLop($row->ID_LOP);
            foreach($getAllBDCount as $c){
                if($row->ID_LOP == $c->ID_LOP){
                    $countHT = $c->SOLUONG;
                }
            }

            $output .= '<tr>';
            $output .= '<td>' . ++$count . '</td>';
            $output .= '<td>' . $row->TENLOP . '</td>';
            $output .= '<td>' . $row->KHOAHOC . '</td>';
            $output .= '<td>' . count($getsvbylop) . '</td>';
            $output .= '<td>' . $countHT . '</td>';
            $output .= '<td class="operation-class" style="margin: 0;">' . 
                '<div class="list-student-score" value="' . $row->ID_LOP  . ' ' . $hocky . '/' . $namhoc . '">
                    <img class="icon-table" src="./images/list.png" alt="">
                    Chấm Điểm Cho Lớp
                </div>'
            . '</td>';
            $output .= '</tr>';
        }
    } else {
        $output .= '<tr><td colspan="2">Không tìm thấy kết quả</td></tr>';
    }
    echo $output;
?>