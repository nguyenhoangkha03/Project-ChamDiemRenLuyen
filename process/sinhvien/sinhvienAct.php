<?php 
    require '../../database/sinhvienCls.php';
    if(isset($_GET['idlop'])){
        $idlop = $_GET['idlop'];
    }
    if(isset($_GET['reqact'])){
        $requestAction = $_GET['reqact'];
        switch($requestAction){
            case 'addNew':
                $mssv = $_POST['mssv'];
                $hoten = $_POST['hoten'];
                $ngaysinh = $_POST['ngaysinh'];
                $gioitinh = $_POST['gioitinh'];
                if($gioitinh == 'nam'){
                    $gioitinh = true;
                }
                else{
                    $gioitinh = false;
                }
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                if (isset($_FILES['file-upload']['tmp_name'])) {
                    $hinhanh = $_FILES['file-upload']['tmp_name'];
                    $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh)));
                } else {
                    echo 'Tải file lên';
                }


                $sinhvien = new Sinhvien();
                $result = $sinhvien->SinhVienAdd($mssv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, null, null, $idlop);

                if($result){
                    header('location:../../index.php?request=sinhvienView&idlop=' . $idlop . '&result=ok');
                }
                else{
                    header('location:../../index.php?request=sinhvienView&idlop=' . $idlop . '&result=notok');
                }
                break;
            case 'delete':
                $idsv = $_GET['idsv'];
                $sinhvien = new Sinhvien();
                $getsv = $sinhvien->SinhVienGetById($idsv);

                $result = $sinhvien->SinhVienDelete($idsv);
                if($result){
                    header('location:../../index.php?request=sinhvienView&idlop=' . $getsv->ID_SV . '&result=ok');
                }
                else{
                    header('location:../../index.php?request=sinhvienView&idlop=' . $getsv->ID_SV . '&result=notok');
                }

                break;
            case 'update':
                $idsv = $_GET['idsv'];
                $sinhvien = new Sinhvien();
                $getsv = $sinhvien->SinhVienGetById($idsv);

                $mssv = $_POST['mssv'];
                $hoten = $_POST['hoten'];
                $ngaysinh = $_POST['ngaysinh'];
                $gioitinh = $_POST['gioitinh'];
                if($gioitinh == 'nam'){
                    $gioitinh = true;
                }
                else{
                    $gioitinh = false;
                }
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                if ($_FILES['file-upload']['error'] == 0) {
                    $hinhanh = $_FILES['file-upload']['tmp_name'];
                    $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh)));
                } else {
                    $hinhanh = $getsv->HINHANH;
                }


                $result = $sinhvien->SinhVienUpdate($mssv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, null, null, $getsv->ID_LOP, $idsv);
                
                if($result){
                    header('location:../../index.php?request=sinhvienView&idlop=' . $getsv->ID_LOP . '&result=ok');
                }
                else{
                    header('location:../../index.php?request=sinhvienView&idlop=' . $getsv->ID_LOP . '&result=notok');
                }

                break;
            case 'addNewBCH':
                $mssv = $_POST['mssv'];
                $idlop = $_POST['lop'];
                $hoten = $_POST['hoten'];
                $chucvu = $_POST['chucvu'];
                $ngaysinh = $_POST['ngaysinh'];
                $gioitinh = $_POST['gioitinh'];
                if($gioitinh == 'nam'){
                    $gioitinh = true;
                }
                else{
                    $gioitinh = false;
                }
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                if (isset($_FILES['file-upload']['tmp_name'])) {
                    $hinhanh = $_FILES['file-upload']['tmp_name'];
                    $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh)));
                } else {
                    echo 'Tải file lên';
                }


                $sinhvien = new Sinhvien();
                $result = $sinhvien->SinhVienAdd($mssv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, true, $chucvu, $idlop);

                if($result){
                    header('location:../../index.php?request=bchView&result=ok');
                }
                else{
                    header('location:../../index.php?request=bchView&result=notok');
                }

                break;
            case 'updateBCH':
                $idsv = $_GET['idsv'];
                $sinhvien = new Sinhvien();
                $getsv = $sinhvien->SinhVienGetById($idsv);
                $mssv = $_POST['mssv'];
                $idlop = $_POST['lop'];
                $hoten = $_POST['hoten'];
                $chucvu = $_POST['chucvu'];
                $ngaysinh = $_POST['ngaysinh'];
                $gioitinh = $_POST['gioitinh'];
                if($gioitinh == 'nam'){
                    $gioitinh = true;
                }
                else{
                    $gioitinh = false;
                }
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                if ($_FILES['file-upload']['error'] == 0) {
                    $hinhanh = $_FILES['file-upload']['tmp_name'];
                    $hinhanh = base64_encode(file_get_contents(addslashes($hinhanh)));
                } else {
                    $hinhanh = $getsv->HINHANH;
                }


                $sinhvien = new Sinhvien();
                $result = $sinhvien->SinhVienUpdate($mssv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, true, $chucvu, $idlop, $idsv);

                if($result){
                    header('location:../../index.php?request=bchView&result=ok');
                }
                else{
                    header('location:../../index.php?request=bchView&result=notok');
                }

                break;
            case 'deleteBCH':
                $idsv = $_GET['idsv'];
                $sinhvien = new Sinhvien();
                $getsv = $sinhvien->SinhVienGetById($idsv);

                $result = $sinhvien->SinhVienDelete($idsv);
                if($result){
                    header('location:../../index.php?request=bchView&result=ok');
                }
                else{
                    header('location:../../index.php?request=bchView&result=notok');
                }

                break;
        }
    }
?>