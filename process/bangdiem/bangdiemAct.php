<?php 
    session_start();
    require '../../database/bangdiemCls.php';
    require '../../database/minhchungCls.php';
    if(isset($_GET['reqact'])){
        $requestAction = $_GET['reqact'];
        switch($requestAction){
            case 'createBD':
                $idsv = $_GET['idsv'];
                $selectNam = $_POST['selectNam'];
                $selectHK = $_POST['selectHK'];
                $tungay = $_POST['tungay'];
                $denngay = $_POST['denngay'];
                
                $bangdiem = new Bangdiem();
                $result = $bangdiem->BangdiemAddByBCH($selectHK, $selectNam, $tungay, $denngay, $idsv, 1, 1);

                if($result){
                    header('location:../../index.php?request=scoreView&result=ok');
                }   
                else{
                    header('location:../../index.php?request=scoreView&result=notok');
                }
                
                break;
            case 'lockBD':
                $idsv = $_GET['idsv'];
                $bangdiem = new Bangdiem();
                $bangdiemLast = $bangdiem->BangdiemLastOfIDSV($idsv);
                
                $result = $bangdiem->BangdiemLock($bangdiemLast->ID_BD);
                if($result){
                    header('location:../../index.php?request=scoreView&result=ok');
                }   
                else{
                    header('location:../../index.php?request=scoreView&result=notok');
                }

                break;
            case 'openBD':
                $idsv = $_GET['idsv'];
                $bangdiem = new Bangdiem();
                $bangdiemLast = $bangdiem->BangdiemLastOfIDSV($idsv);
                
                $result = $bangdiem->BangdiemOpen($bangdiemLast->ID_BD);
                if($result){
                    header('location:../../index.php?request=scoreView&result=ok');
                }   
                else{
                    header('location:../../index.php?request=scoreView&result=notok');
                }

                break;
            case 'chamdiem':
                $idsv = $_GET['idsv'];
                if(isset($_SESSION['ADMIN']) || isset($_SESSION['BCH'])){
                    
                }
                else if(isset($_SESSION['BCS'])){
                    
                }
                else {
                    // Phan 1
                    $c111 = $_POST['sv-111']; $c112 = $_POST['sv-112']; $c113 = $_POST['sv-113']; $c114 = $_POST['sv-114']; $c115 = $_POST['sv-115'];
                    $c116 = $_POST['sv-116']; $c117 = $_POST['sv-117']; $c118 = $_POST['sv-118']; $c119 = $_POST['sv-119'];
                    $t121 = $_POST['sv-121']; $t122 = $_POST['sv-122'];
                    $sum1 = (int)$c111 + (int)$c112 + (int)$c113 + (int)$c114 + (int)$c115 + (int)$c116 + (int)$c117 + (int)$c118 + (int)$c119 - (int)$t121 - (int)$t121;
                    
                    
                    if (isset($_FILES['files113']['name'])) {
                        foreach ($_FILES['files113']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum1 -= (int)$c113;
                            }
                        }
                    }
                    if (isset($_FILES['files114']['name'])) {
                        foreach ($_FILES['files114']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum1 -= (int)$c114;
                            }
                        }
                    } 
                    if (isset($_FILES['files115']['name'])) {
                        foreach ($_FILES['files115']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum1 -= (int)$c115;
                            }
                        }
                    } 
                    if (isset($_FILES['files116']['name'])) {
                        foreach ($_FILES['files116']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum1 -= (int)$c116;
                            }
                        }
                    }
                    if (isset($_FILES['files117']['name'])) {
                        foreach ($_FILES['files117']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum1 -= (int)$c117;
                            }
                        }
                    }
                    if (isset($_FILES['files118']['name'])) {
                        foreach ($_FILES['files118']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum1 -= (int)$c118;
                            }
                        }
                    }

                    // Phan 2
                    $c211 = $_POST['sv-211']; $c212 = $_POST['sv-212'];
                    $t221 = $_POST['sv-221']; $t222 = $_POST['sv-222']; $t223 = $_POST['sv-223']; $t224 = $_POST['sv-224']; $t225 = $_POST['sv-225'];
                    $t226 = $_POST['sv-226']; $t227 = $_POST['sv-227'];
                    $sum2 = (int)$c211 + (int)$c212 - (int)$t221 - (int)$t222 - (int)$t223 - (int)$t224 - (int)$t225 - (int)$t226 - (int)$t227;

                    // Phan 3
                    $c311 = $_POST['sv-311']; $c312 = $_POST['sv-312']; $c313 = $_POST['sv-313']; $c314 = $_POST['sv-314']; $c315 = $_POST['sv-315'];
                    $c316 = $_POST['sv-316'];
                    $t321 = $_POST['sv-321']; $t322 = $_POST['sv-322'];
                    $sum3 = $c311 + $c312 + $c313 + $c314 + $c315 + $c316 - $t321 - $t322;

                    if (isset($_FILES['files311']['name'])) {
                        foreach ($_FILES['files311']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum3 -= (int)$c311;
                            }
                        }
                    }
                    if (isset($_FILES['files312']['name'])) {
                        foreach ($_FILES['files312']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum3 -= (int)$c312;
                            }
                        }
                    }
                    if (isset($_FILES['files313']['name'])) {
                        foreach ($_FILES['files313']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum3 -= (int)$c313;
                            }
                        }
                    }
                    if (isset($_FILES['files314']['name'])) {
                        foreach ($_FILES['files314']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum3 -= (int)$c314;
                            }
                        }
                    }
                    if (isset($_FILES['files315']['name'])) {
                        foreach ($_FILES['files315']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum3 -= (int)$c315;
                            }
                        }
                    }
                    if (isset($_FILES['files316']['name'])) {
                        foreach ($_FILES['files316']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum3 -= (int)$c316;
                            }
                        }
                    }

                    // Phan 4
                    $c411 = $_POST['sv-411']; $c412 = $_POST['sv-412']; $c413 = $_POST['sv-413']; $c414 = $_POST['sv-414']; $c415 = $_POST['sv-415'];
                    $c416 = $_POST['sv-416'];
                    $sum4 = $c411 + $c412 + $c413 + $c414 + $c415 + $c416;

                    if (isset($_FILES['files416']['name'])) {
                        foreach ($_FILES['files416']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum4 -= (int)$c416;
                            }
                        }
                    }

                    // Phan 5
                    $c511 = $_POST['sv-511']; $c512 = $_POST['sv-512']; $c513 = $_POST['sv-513']; $c514 = $_POST['sv-514']; $c515 = $_POST['sv-515'];
                    $c516 = $_POST['sv-516']; $c517 = $_POST['sv-517']; $c518 = $_POST['sv-518'];
                    $sum5 = $c511 + $c512 + $c513 + $c514 + $c515 + $c516 + $c517 + $c518;

                    if (isset($_FILES['files512']['name'])) {
                        foreach ($_FILES['files512']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c512;
                            }
                        }
                    }
                    if (isset($_FILES['files513']['name'])) {
                        foreach ($_FILES['files513']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c513;
                            }
                        }
                    }
                    if (isset($_FILES['files514']['name'])) {
                        foreach ($_FILES['files514']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c514;
                            }
                        }
                    }
                    if (isset($_FILES['files515']['name'])) {
                        foreach ($_FILES['files515']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c515;
                            }
                        }
                    }
                    if (isset($_FILES['files516']['name'])) {
                        foreach ($_FILES['files516']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c516;
                            }
                        }
                    }
                    if (isset($_FILES['files517']['name'])) {
                        foreach ($_FILES['files517']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c517;
                            }
                        }
                    }
                    if (isset($_FILES['files518']['name'])) {
                        foreach ($_FILES['files518']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c518;
                            }
                        }
                    }

                    // Tong
                    $sum = $sum1 + $sum2 + $sum3 + $sum4 + $sum5;
                    echo $sum;
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