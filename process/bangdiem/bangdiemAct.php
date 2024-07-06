<?php 
    session_start();
    require '../../database/bangdiemCls.php';
    require '../../database/minhchungCls.php';
    require '../../database/diemtcCls.php';
    require '../../database/diemtcctCls.php';
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
                    if($sum1 > 20){
                        $sum1 = 20;
                    }

                    // Phan 2
                    $c211 = $_POST['sv-211']; $c212 = $_POST['sv-212'];
                    $t221 = $_POST['sv-221']; $t222 = $_POST['sv-222']; $t223 = $_POST['sv-223']; $t224 = $_POST['sv-224']; $t225 = $_POST['sv-225'];
                    $t226 = $_POST['sv-226']; $t227 = $_POST['sv-227'];
                    $sum2 = (int)$c211 + (int)$c212 - (int)$t221 - (int)$t222 - (int)$t223 - (int)$t224 - (int)$t225 - (int)$t226 - (int)$t227;
                    if($sum2 > 25){
                        $sum2 = 25;
                    }

                    // Phan 3
                    $c311 = $_POST['sv-311']; $c312 = $_POST['sv-312']; $c313 = $_POST['sv-313']; $c314 = $_POST['sv-314']; $c315 = $_POST['sv-315'];
                    $c316 = $_POST['sv-316'];
                    $t321 = $_POST['sv-321']; $t322 = $_POST['sv-322'];
                    $sum3 = (int)$c311 + (int)$c312 + (int)$c313 + (int)$c314 + (int)$c315 + (int)$c316 - (int)$t321 - (int)$t322;

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
                    if($sum3 > 20){
                        $sum3 = 20;
                    }

                    // Phan 4
                    $c411 = $_POST['sv-411']; $c412 = $_POST['sv-412']; $c413 = $_POST['sv-413']; $c414 = $_POST['sv-414']; $c415 = $_POST['sv-415'];
                    $c416 = $_POST['sv-416'];
                    $sum4 = (int)$c411 + (int)$c412 + (int)$c413 + (int)$c414 + (int)$c415 + (int)$c416;

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
                    if($sum4 > 25){
                        $sum4 = 25;
                    }

                    // Phan 5
                    $c511 = $_POST['sv-511']; $c512 = $_POST['sv-512']; $c513 = $_POST['sv-513']; $c514 = $_POST['sv-514']; $c515 = $_POST['sv-515'];
                    $c516 = $_POST['sv-516']; $c517 = $_POST['sv-517']; $c518 = $_POST['sv-518'];
                    $sum5 = (int)$c511 + (int)$c512 + (int)$c513 + (int)$c514 + (int)$c515 + (int)$c516 + (int)$c517 + (int)$c518;

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
                    if($sum5 > 10){
                        $sum5 = 10;
                    }

                    // Tong
                    $sum = (int)$sum1 + (int)$sum2 + (int)$sum3 + (int)$sum4 + (int)$sum5;
                    
                    // Insert
                    $bangdiem = new Bangdiem();
                    $diemtc = new DiemTC();
                    $diemtcct = new DiemTCCT();
                    $getcheck = $bangdiem->BangdiemGetbyCheckBoth(1, 1);
                    $idbd = ($bangdiem->BangdiemLastOfIDSV($idsv))->ID_BD;
                    if($getcheck != null){
                        $resultBD = $bangdiem->BangdiemAdd($getcheck->HOCKY, $getcheck->NAMHOC, $sum, null, null, $idsv);
                        // Diem TC
                        $resultDTC1 = $diemtc->DiemTCAdd($sum1, null, null, $idbd, 1);   
                        $resultDTC2 = $diemtc->DiemTCAdd($sum2, null, null, $idbd, 2);   
                        $resultDTC3 = $diemtc->DiemTCAdd($sum3, null, null, $idbd, 3);   
                        $resultDTC4 = $diemtc->DiemTCAdd($sum4, null, null, $idbd, 4);   
                        $resultDTC5 = $diemtc->DiemTCAdd($sum5, null, null, $idbd, 5);   
                        // Diem TCCT1
                        $resultDTCCT1 = $diemtcct->DiemTCCTAdd($c111, 0, 0, $idbd, 1);
                        $resultDTTCT2 = $diemtcct->DiemTCCTAdd($c112, 0, 0, $idbd, 2);
                        $resultDTTCT3 = $diemtcct->DiemTCCTAdd($c113, 0, 0, $idbd, 3);
                        $resultDTTCT4 = $diemtcct->DiemTCCTAdd($c114, 0, 0, $idbd, 4);
                        $resultDTTCT5 = $diemtcct->DiemTCCTAdd($c115, 0, 0, $idbd, 5);
                        $resultDTTCT6 = $diemtcct->DiemTCCTAdd($c116, 0, 0, $idbd, 6);
                        $resultDTTCT7 = $diemtcct->DiemTCCTAdd($c117, 0, 0, $idbd, 7);
                        $resultDTTCT8 = $diemtcct->DiemTCCTAdd($c118, 0, 0, $idbd, 8);
                        $resultDTTCT9 = $diemtcct->DiemTCCTAdd($c119, 0, 0, $idbd, 9);
                        $resultDTTCT10 = $diemtcct->DiemTCCTAdd($c121, 0, 0, $idbd, 10);
                        $resultDTTCT11 = $diemtcct->DiemTCCTAdd($c122, 0, 0, $idbd, 11);
                        $resultDTTCT12 = $diemtcct->DiemTCCTAdd($c123, 0, 0, $idbd, 12);
                        $resultDTTCT13 = $diemtcct->DiemTCCTAdd($c124, 0, 0, $idbd, 13);
                        $resultDTTCT14 = $diemtcct->DiemTCCTAdd($c125, 0, 0, $idbd, 14);
                        $resultDTTCT15 = $diemtcct->DiemTCCTAdd($c126, 0, 0, $idbd, 15);
                        $resultDTTCT16 = $diemtcct->DiemTCCTAdd($c127, 0, 0, $idbd, 16);
                        $resultDTTCT17 = $diemtcct->DiemTCCTAdd($c128, 0, 0, $idbd, 17);
                        $resultDTTCT18 = $diemtcct->DiemTCCTAdd($c129, 0, 0, $idbd, 18);
                        $resultDTTCT19 = $diemtcct->DiemTCCTAdd($c131, 0, 0, $idbd, 19);
                        $resultDTTCT20 = $diemtcct->DiemTCCTAdd($c132, 0, 0, $idbd, 20);
                        $resultDTTCT21 = $diemtcct->DiemTCCTAdd($c133, 0, 0, $idbd, 21);
                        $resultDTTCT22 = $diemtcct->DiemTCCTAdd($c134, 0, 0, $idbd, 22);
                        $resultDTTCT23 = $diemtcct->DiemTCCTAdd($c135, 0, 0, $idbd, 23);
                        $resultDTTCT24 = $diemtcct->DiemTCCTAdd($c136, 0, 0, $idbd, 24);
                        $resultDTTCT25 = $diemtcct->DiemTCCTAdd($c137, 0, 0, $idbd, 25);
                        $resultDTTCT26 = $diemtcct->DiemTCCTAdd($c138, 0, 0, $idbd, 26);
                        $resultDTTCT27 = $diemtcct->DiemTCCTAdd($c139, 0, 0, $idbd, 27);
                        $resultDTTCT28 = $diemtcct->DiemTCCTAdd($c141, 0, 0, $idbd, 28);
                        $resultDTTCT29 = $diemtcct->DiemTCCTAdd($c142, 0, 0, $idbd, 29);
                        $resultDTTCT30 = $diemtcct->DiemTCCTAdd($c143, 0, 0, $idbd, 30);
                        $resultDTTCT31 = $diemtcct->DiemTCCTAdd($c144, 0, 0, $idbd, 31);
                        $resultDTTCT32 = $diemtcct->DiemTCCTAdd($c145, 0, 0, $idbd, 32);
                        $resultDTTCT33 = $diemtcct->DiemTCCTAdd($c146, 0, 0, $idbd, 33);
                        $resultDTTCT34 = $diemtcct->DiemTCCTAdd($c147, 0, 0, $idbd, 34);
                        $resultDTTCT35 = $diemtcct->DiemTCCTAdd($c148, 0, 0, $idbd, 35);
                        $resultDTTCT36 = $diemtcct->DiemTCCTAdd($c149, 0, 0, $idbd, 36);
                        $resultDTTCT37 = $diemtcct->DiemTCCTAdd($c1513, 0, 0, $idbd, 37);
                        $resultDTTCT38 = $diemtcct->DiemTCCTAdd($c1514, 0, 0, $idbd, 38);
                        $resultDTTCT39 = $diemtcct->DiemTCCTAdd($c1515, 0, 0, $idbd, 39);
                        $resultDTTCT40 = $diemtcct->DiemTCCTAdd($c1516, 0, 0, $idbd, 40);
                        $resultDTTCT41 = $diemtcct->DiemTCCTAdd($c1517, 0, 0, $idbd, 41);
                        $resultDTTCT42 = $diemtcct->DiemTCCTAdd($c1518, 0, 0, $idbd, 42);
                    }
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