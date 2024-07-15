<?php 
    session_start();
    require '../../database/taikhoanCls.php';
    require '../../database/quyenCls.php';
    if(isset($_GET['reqact'])){
        $requestAction = $_GET['reqact'];
        switch($requestAction){
            case 'checklogin':
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                $taikhoan = new Taikhoan();
                $check = $taikhoan->TaikhoanCheckLogin($username, $password);
                if($check != null){
                    $quyen = new Quyen();
                    $getquyen = $quyen->QuyenGetbyId($check->ID_QUYEN);
                    if($getquyen->MAQUYEN == 'admin'){
                        $_SESSION['ADMIN'] = $username;
                        header('location:../../index.php');
                    }
                    else if($getquyen->MAQUYEN == 'bch'){
                        $_SESSION['BCH'] = $username;
                        header('location:../../index.php');
                    }
                    else if($getquyen->MAQUYEN == 'bcs'){
                        $_SESSION['BCS'] = $username;
                        header('location:../../index.php');
                    }
                    else{
                        $_SESSION['STUDENT'] = $username;
                        header('location:../../index.php');
                    }
                }
                else{
                    echo '<script>';
                    echo 'if(confirm("Sai tài khoản hoặc mật khẩu")){';
                    echo 'window.location.href="../../login/index.php"';
                    echo '}else{';
                    echo 'window.location.href="../../login/index.php"';
                    echo '}';
                    echo '</script>';
                }

                break;
            case 'logout':
                $timelogin = date('h:i - d/m/Y', strtotime('+5 hours'));
                if(isset($_SESSION['ADMIN'])){
                    $namelogin = $_SESSION['ADMIN'];
                }
                else if(isset($_SESSION['BCH'])){
                    $namelogin = $_SESSION['BCH'];
                }
                else if(isset($_SESSION['BCS'])){
                    $namelogin = $_SESSION['BCS'];
                }
                else{
                    $namelogin = $_SESSION['STUDENT'];
                }
                setcookie($namelogin, $timelogin, time() + (86400 * 30), "/");
                
                session_destroy();
                header('location:../../index.php');
                break;  
            case 'changePassword':
                if(isset($_SESSION['ADMIN'])){
                    $username = $_SESSION['ADMIN'];
                }
                else if(isset($_SESSION['BCH'])){
                    $username = $_SESSION['BCH'];
                }
                else if(isset($_SESSION['BCS'])){
                    $username = $_SESSION['BCS'];
                }
                else{
                    $username = $_SESSION['STUDENT'];
                }
                $taikhoan = new Taikhoan();
                $gettaikhoan = $taikhoan->TaiKhoanGetByUsername($username);

                $passwordOld = $_POST['passOld'];
                if($gettaikhoan->PASSWORD == $passwordOld){
                    $passwordNew = $_POST['passNew'];
                    $update = $taikhoan->TaiKhoanUpdatePass($passwordNew, $gettaikhoan->ID_TK);
                    header('location:../../index.php?request=profile');
                }
                else{
                    echo '<script>';
                    echo 'if(confirm("Sai mật khẩu")){';
                    echo 'window.location.href="../../index.php?request=profile"';
                    echo '}else{';
                    echo 'window.location.href="../../index.php?request=profile"';
                    echo '}';
                    echo '</script>';
                }
                break;
            case 'addNew':
                $date = date('Y-m-d');
                $username = $_POST['username'];
                $password = $_POST['password'];
                $selectSV = $_POST['selectSV'];
                $selectQuuyen = $_POST['selectQuyen'];
                $trangthai = 1;


                $taikhoan = new Taikhoan();
                $gettk = $taikhoan->TaiKhoanGetByUsername($username);
                if($gettk == null){
                    $result = $taikhoan->TaiKhoanAdd($username,$password,$date,$trangthai,$selectSV,$selectQuuyen);

                    if($result){
                        header('location:../../index.php?request=taikhoanView');
                    }
                    else{
                        header('location:../../index.php?request=taikhoanView');
                    }
                }   
                else{
                    echo '<script>';
                    echo 'if(confirm("Đã tồn tại username!")){';
                    echo 'window.location.href="../../index.php?request=taikhoanAdd"';
                    echo '}else{';
                    echo 'window.location.href="../../index.php?request=taikhoanAdd"';
                    echo '}';
                    echo '</script>';
                }
                break;
            case 'delete':
                $idtk = $_GET['id'];
                $taikhoan = new Taikhoan();

                $result = $taikhoan->TaiKhoanDelete($idtk);
                if($result){
                    header('location:../../index.php?request=taikhoanView');
                }
                else{
                    header('location:../../index.php?request=taikhoanView');
                }

                break;
            case 'update':
                $idtk = $_GET['idtk'];
                $taikhoan = new Taikhoan();
                $gettk = $taikhoan->TaiKhoanGetById($idtk);
                $usernameOld = $gettk->USERNAME;
                $username = $_POST['username'];
                $password = $_POST['password'];
                $selectSV = $_POST['selectSV'];
                $selectQuuyen = $_POST['selectQuyen'];
                $trangthai = 1;
                $gettkNew = $taikhoan->TaiKhoanGetByUsername($username);

                if($gettkNew == null || $usernameOld == $username){
                    $result = $taikhoan->TaiKhoanUpdate($username,$password,$gettk->NGAYCAP, 1, $selectSV, $selectQuuyen,$idtk);
                
                    if($result){
                        header('location:../../index.php?request=taikhoanView');
                    }
                    else{
                        header('location:../../index.php?request=taikhoanView');
                    }
                }
                else{
                    echo '<script>';
                    echo 'if(confirm("Đã tồn tại username!")){';
                    echo 'window.location.href="../../index.php?request=taikhoanUpdate&id=' . $idtk . '"';
                    echo '}else{';
                    echo 'window.location.href="../../index.php?request=taikhoanUpdate&id=' . $idtk . '"';
                    echo '}';
                    echo '</script>';
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