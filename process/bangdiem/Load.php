<?php 
    require '../../database/bangdiemCls.php';
    $bangdiem = new Bangdiem();

    $value = $_POST['value'];
    $idsv = $_POST['idsv'];
    $result = $bangdiem->BangdiemGetByNamHocAndIDSV($value, $idsv);
    
    $count = 0;
    $output = '';

    if(count($result) == 0){
        $output .= '<option value="1">1</option>';
        $output .= '<option value="2">2</option>';
        $output .= '<option value="3">3</option>';
    }
    else if(count($result) == 1){
        $output .= '<option value="2">2</option>';
        $output .= '<option value="3">3</option>';
    }
    else if(count($result) == 2) {
        $output .= '<option value="3">3</option>';
    }
    else{
        $output .= '<option value="default">Không có học kỳ có sẵn!</option>';
    }
    echo $output;
?>