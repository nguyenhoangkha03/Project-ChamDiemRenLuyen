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
                $getbangdiem = $bangdiem->BangdiemGetbyCheckBoth(1,1);
                
                $result = $bangdiem->BangdiemLock($getbangdiem->ID_BD);
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
                $bangdiemLast = $bangdiem->BangdiemGetbyCheckBoth(1,0);
                
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
                    // Phan 1
                    // Sinhvien
                    $c111 = $_POST['sv-111']; $c112 = $_POST['sv-112']; $c113 = $_POST['sv-113']; $c114 = $_POST['sv-114']; $c115 = $_POST['sv-115'];
                    $c116 = $_POST['sv-116']; $c117 = $_POST['sv-117']; $c118 = $_POST['sv-118']; $c119 = $_POST['sv-119'];
                    $t121 = $_POST['sv-121']; $t122 = $_POST['sv-122'];
                    $sum1 = (int)$c111 + (int)$c112 + (int)$c113 + (int)$c114 + (int)$c115 + (int)$c116 + (int)$c117 + (int)$c118 + (int)$c119 - (int)$t121 - (int)$t121;
                    // Lop
                    $lc111 = $_POST['lop-111']; $lc112 = $_POST['lop-112']; $lc113 = $_POST['lop-113']; $lc114 = $_POST['lop-114']; $lc115 = $_POST['lop-115'];
                    $lc116 = $_POST['lop-116']; $lc117 = $_POST['lop-117']; $lc118 = $_POST['lop-118']; $lc119 = $_POST['lop-119'];
                    $lt121 = $_POST['lop-121']; $lt122 = $_POST['lop-122'];
                    $suml1 = (int)$lc111 + (int)$lc112 + (int)$lc113 + (int)$lc114 + (int)$lc115 + (int)$lc116 + (int)$lc117 + (int)$lc118 + (int)$lc119 - (int)$lt121 - (int)$lt121;
                    // Khoa
                    $kc111 = $_POST['khoa-111']; $kc112 = $_POST['khoa-112']; $kc113 = $_POST['khoa-113']; $kc114 = $_POST['khoa-114']; $kc115 = $_POST['khoa-115'];
                    $kc116 = $_POST['khoa-116']; $kc117 = $_POST['khoa-117']; $kc118 = $_POST['khoa-118']; $kc119 = $_POST['khoa-119'];
                    $kt121 = $_POST['khoa-121']; $kt122 = $_POST['khoa-122'];
                    $sumk1 = (int)$kc111 + (int)$kc112 + (int)$kc113 + (int)$kc114 + (int)$kc115 + (int)$kc116 + (int)$kc117 + (int)$kc118 + (int)$kc119 - (int)$kt121 - (int)$kt121;
                    
                    if (isset($_FILES['files113']['name'])) {
                        foreach ($_FILES['files113']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum1 -= (int)$c113; 
                                $suml1 -= (int)$lc113; 
                                $sumk1 -= (int)$kc113; 
                                $c113 = 0;
                                $lc113 = 0;
                                $kc113 = 0;
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
                                $suml1 -= (int)$lc114;
                                $sumk1 -= (int)$kc114;
                                $c114 = 0;
                                $lc114 = 0;
                                $kc114 = 0;
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
                                $suml1 -= (int)$lc115;
                                $sumk1 -= (int)$kc115;
                                $c115 = 0;
                                $lc115 = 0;
                                $kc115 = 0;
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
                                $suml1 -= (int)$lc116;
                                $sumk1 -= (int)$kc116;
                                $c116 = 0;
                                $lc116 = 0;
                                $kc116 = 0;
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
                                $suml1 -= (int)$lc117;
                                $sumk1 -= (int)$kc117;
                                $c117 = 0;
                                $lc117 = 0;
                                $kc117 = 0;
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
                                $suml1 -= (int)$lc118;
                                $sumk1 -= (int)$kc118;
                                $c118 = 0;
                                $lc118 = 0;
                                $kc118 = 0;
                            }
                        }
                    }
                    if($sum1 > 20){
                        $sum1 = 20;
                    }
                    if($suml1 > 20){
                        $suml1 = 20;
                    }
                    if($sumk1 > 20){
                        $sumk1 = 20;
                    }

                    // Phan 2
                    // Sinhvien
                    $c211 = $_POST['sv-211']; $c212 = $_POST['sv-212'];
                    $t221 = $_POST['sv-221']; $t222 = $_POST['sv-222']; $t223 = $_POST['sv-223']; $t224 = $_POST['sv-224']; $t225 = $_POST['sv-225'];
                    $t226 = $_POST['sv-226']; $t227 = $_POST['sv-227'];
                    $sum2 = (int)$c211 + (int)$c212 - (int)$t221 - (int)$t222 - (int)$t223 - (int)$t224 - (int)$t225 - (int)$t226 - (int)$t227;
                    // Lop
                    $lc211 = $_POST['lop-211']; $lc212 = $_POST['lop-212'];
                    $lt221 = $_POST['lop-221']; $lt222 = $_POST['lop-222']; $lt223 = $_POST['lop-223']; $lt224 = $_POST['lop-224']; $lt225 = $_POST['lop-225'];
                    $lt226 = $_POST['lop-226']; $lt227 = $_POST['lop-227'];
                    $suml2 = (int)$lc211 + (int)$lc212 - (int)$lt221 - (int)$lt222 - (int)$lt223 - (int)$lt224 - (int)$lt225 - (int)$lt226 - (int)$lt227;
                    // Khoa
                    $kc211 = $_POST['khoa-211']; $kc212 = $_POST['khoa-212'];
                    $kt221 = $_POST['khoa-221']; $kt222 = $_POST['khoa-222']; $kt223 = $_POST['khoa-223']; $kt224 = $_POST['khoa-224']; $kt225 = $_POST['khoa-225'];
                    $kt226 = $_POST['khoa-226']; $kt227 = $_POST['khoa-227'];
                    $sumk2 = (int)$kc211 + (int)$kc212 - (int)$kt221 - (int)$kt222 - (int)$kt223 - (int)$kt224 - (int)$kt225 - (int)$kt226 - (int)$kt227;
                    if($sum2 > 25){
                        $sum2 = 25;
                    }
                    if($suml2 > 25){
                        $suml2 = 25;
                    }
                    if($sumk2 > 25){
                        $sumk2 = 25;
                    }

                    // Phan 3
                    // Sinh vien
                    $c311 = $_POST['sv-311']; $c312 = $_POST['sv-312']; $c313 = $_POST['sv-313']; $c314 = $_POST['sv-314']; $c315 = $_POST['sv-315'];
                    $c316 = $_POST['sv-316'];
                    $t321 = $_POST['sv-321']; $t322 = $_POST['sv-322'];
                    $sum3 = (int)$c311 + (int)$c312 + (int)$c313 + (int)$c314 + (int)$c315 + (int)$c316 - (int)$t321 - (int)$t322;
                    // Lop
                    $lc311 = $_POST['lop-311']; $lc312 = $_POST['lop-312']; $lc313 = $_POST['lop-313']; $lc314 = $_POST['lop-314']; $lc315 = $_POST['lop-315'];
                    $lc316 = $_POST['lop-316'];
                    $lt321 = $_POST['lop-321']; $lt322 = $_POST['lop-322'];
                    $suml3 = (int)$lc311 + (int)$lc312 + (int)$lc313 + (int)$lc314 + (int)$lc315 + (int)$lc316 - (int)$lt321 - (int)$lt322;
                    // Khoa
                    $kc311 = $_POST['khoa-311']; $kc312 = $_POST['khoa-312']; $kc313 = $_POST['khoa-313']; $kc314 = $_POST['khoa-314']; $kc315 = $_POST['khoa-315'];
                    $kc316 = $_POST['khoa-316'];
                    $kt321 = $_POST['khoa-321']; $kt322 = $_POST['khoa-322'];
                    $sumk3 = (int)$kc311 + (int)$kc312 + (int)$kc313 + (int)$kc314 + (int)$kc315 + (int)$kc316 - (int)$kt321 - (int)$kt322;

                    if (isset($_FILES['files311']['name'])) {
                        foreach ($_FILES['files311']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum3 -= (int)$c311;
                                $suml3 -= (int)$lc311;
                                $sumk3 -= (int)$kc311;
                                $c311 = 0;
                                $lc311 = 0;
                                $kc311 = 0;
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
                                $suml3 -= (int)$lc312;
                                $sumk3 -= (int)$kc312;
                                $c312 = 0;
                                $lc312 = 0;
                                $kc312 = 0;
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
                                $suml3 -= (int)$lc313;
                                $sumk3 -= (int)$kc313;
                                $c313 = 0;
                                $lc313 = 0;
                                $kc313 = 0;
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
                                $suml3 -= (int)$lc314;
                                $sumk3 -= (int)$kc314;
                                $c314 = 0;
                                $lc314 = 0;
                                $kc314 = 0;
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
                                $suml3 -= (int)$lc315;
                                $sumk3 -= (int)$kc315;
                                $c315 = 0;
                                $lc315 = 0;
                                $kc315 = 0;
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
                                $suml3 -= (int)$lc316;
                                $sumk3 -= (int)$kc316;
                                $c316 = 0;
                                $lc316 = 0;
                                $kc316 = 0;
                            }
                        }
                    }
                    if($sum3 > 20){
                        $sum3 = 20;
                    }
                    if($suml3 > 20){
                        $suml3 = 20;
                    }
                    if($sumk3 > 20){
                        $sumk3 = 20;
                    }

                    // Phan 4
                    // Sinhvien
                    $c411 = $_POST['sv-411']; $c412 = $_POST['sv-412']; $c413 = $_POST['sv-413']; $c414 = $_POST['sv-414']; $c415 = $_POST['sv-415'];
                    $c416 = $_POST['sv-416'];
                    $sum4 = (int)$c411 + (int)$c412 + (int)$c413 + (int)$c414 + (int)$c415 + (int)$c416;
                    // Lop
                    $lc411 = $_POST['lop-411']; $lc412 = $_POST['lop-412']; $lc413 = $_POST['lop-413']; $lc414 = $_POST['lop-414']; $lc415 = $_POST['lop-415'];
                    $lc416 = $_POST['lop-416'];
                    $suml4 = (int)$lc411 + (int)$lc412 + (int)$lc413 + (int)$lc414 + (int)$lc415 + (int)$lc416;
                    // Khoa
                    $kc411 = $_POST['khoa-411']; $kc412 = $_POST['khoa-412']; $kc413 = $_POST['khoa-413']; $kc414 = $_POST['khoa-414']; $kc415 = $_POST['khoa-415'];
                    $kc416 = $_POST['khoa-416'];
                    $sumk4 = (int)$kc411 + (int)$kc412 + (int)$kc413 + (int)$kc414 + (int)$kc415 + (int)$kc416;

                    if (isset($_FILES['files416']['name'])) {
                        foreach ($_FILES['files416']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum4 -= (int)$c416;
                                $suml4 -= (int)$lc416;
                                $sumk4 -= (int)$kc416;
                                $c416 = 0;
                                $lc416 = 0;
                                $kc416 = 0;
                            }
                        }
                    }
                    if($sum4 > 25){
                        $sum4 = 25;
                    }
                    if($suml4 > 25){
                        $suml4 = 25;
                    }
                    if($sumk4 > 25){
                        $sumk4 = 25;
                    }

                    // Phan 5
                    // Sinhvien
                    $c511 = $_POST['sv-511']; $c512 = $_POST['sv-512']; $c513 = $_POST['sv-513']; $c514 = $_POST['sv-514']; $c515 = $_POST['sv-515'];
                    $c516 = $_POST['sv-516']; $c517 = $_POST['sv-517']; $c518 = $_POST['sv-518'];
                    $sum5 = (int)$c511 + (int)$c512 + (int)$c513 + (int)$c514 + (int)$c515 + (int)$c516 + (int)$c517 + (int)$c518;
                    // Lop
                    $lc511 = $_POST['lop-511']; $lc512 = $_POST['lop-512']; $lc513 = $_POST['lop-513']; $lc514 = $_POST['lop-514']; $lc515 = $_POST['lop-515'];
                    $lc516 = $_POST['lop-516']; $lc517 = $_POST['lop-517']; $lc518 = $_POST['lop-518'];
                    $suml5 = (int)$lc511 + (int)$lc512 + (int)$lc513 + (int)$lc514 + (int)$lc515 + (int)$lc516 + (int)$lc517 + (int)$lc518;
                    // Khoa
                    $kc511 = $_POST['khoa-511']; $kc512 = $_POST['khoa-512']; $kc513 = $_POST['khoa-513']; $kc514 = $_POST['khoa-514']; $kc515 = $_POST['khoa-515'];
                    $kc516 = $_POST['khoa-516']; $kc517 = $_POST['khoa-517']; $kc518 = $_POST['khoa-518'];
                    $sumk5 = (int)$kc511 + (int)$kc512 + (int)$kc513 + (int)$kc514 + (int)$kc515 + (int)$kc516 + (int)$kc517 + (int)$kc518;

                    if (isset($_FILES['files512']['name'])) {
                        foreach ($_FILES['files512']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c512;
                                $suml5 -= (int)$lc512;
                                $sumk5 -= (int)$kc512;
                                $c512 = 0;
                                $lc512 = 0;
                                $kc512 = 0;
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
                                $suml5 -= (int)$lc513;
                                $sumk5 -= (int)$kc513;
                                $c513 = 0;
                                $lc513 = 0;
                                $kc513 = 0;
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
                                $suml5 -= (int)$lc514;
                                $sumk5 -= (int)$kc514;
                                $c514 = 0;
                                $lc514 = 0;
                                $kc514 = 0;
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
                                $suml5 -= (int)$lc515;
                                $sumk5 -= (int)$kc515;
                                $c515 = 0;
                                $lc515 = 0;
                                $kc515 = 0;
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
                                $suml5 -= (int)$lc516;
                                $sumk5 -= (int)$kc516;
                                $c516 = 0;
                                $lc516 = 0;
                                $kc516 = 0;
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
                                $suml5 -= (int)$lc517;
                                $sumk5 -= (int)$kc517;
                                $c517 = 0;
                                $lc517 = 0;
                                $kc517 = 0;
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
                                $suml5 -= (int)$lc518;
                                $sumk5 -= (int)$kc518;
                                $c518 = 0;
                                $lc518 = 0;
                                $kc518 = 0;
                            }
                        }
                    }
                    if($sum5 > 10){
                        $sum5 = 10;
                    }
                    if($suml5 > 10){
                        $suml5 = 10;
                    }
                    if($sumk5 > 10){
                        $sumk5 = 10;
                    }

                    // Tong
                    $sum = (int)$sum1 + (int)$sum2 + (int)$sum3 + (int)$sum4 + (int)$sum5;
                    $suml = (int)$suml1 + (int)$suml2 + (int)$suml3 + (int)$suml4 + (int)$suml5;
                    $sumk = (int)$sumk1 + (int)$sumk2 + (int)$sumk3 + (int)$sumk4 + (int)$sumk5;
                    
                    // Insert
                    $bangdiem = new Bangdiem();
                    $diemtc = new DiemTC();
                    $diemtcct = new DiemTCCT();
                    $getcheck = $bangdiem->BangdiemGetbyCheckBoth(1, 1);
                    $getbdofsv = $bangdiem->BangdiemGetbyIdSVAndNHAndHK($idsv, $getcheck->NAMHOC, $getcheck->HOCKY);
                    if($getbdofsv == null){
                        $resultBD = $bangdiem->BangdiemAdd($getcheck->HOCKY, $getcheck->NAMHOC, $sum, $suml, $sumk, $idsv, $getcheck->TUNGAY, $getcheck->DENNGAY);
                        $idbd = ($bangdiem->BangdiemLastOfIDSV($idsv))->ID_BD;
                        // Diem TC
                        $resultDTC1 = $diemtc->DiemTCAdd($sum1, $suml1, $sumk1, $idbd, 1);   
                        $resultDTC2 = $diemtc->DiemTCAdd($sum2, $suml2, $sumk2, $idbd, 2);   
                        $resultDTC3 = $diemtc->DiemTCAdd($sum3, $suml3, $sumk3, $idbd, 3);   
                        $resultDTC4 = $diemtc->DiemTCAdd($sum4, $suml4, $sumk4, $idbd, 4);   
                        $resultDTC5 = $diemtc->DiemTCAdd($sum5, $suml5, $sumk5, $idbd, 5);   
                        // Diem TCCT1
                        $resultDTCCT111 = $diemtcct->DiemTCCTAdd($c111, $lc111, $kc111, $idbd, 1);
                        $resultDTTCT112 = $diemtcct->DiemTCCTAdd($c112, $lc112, $kc112, $idbd, 2);
                        $resultDTTCT113 = $diemtcct->DiemTCCTAdd($c113, $lc113, $kc113, $idbd, 3);
                        if (isset($_FILES['files113']['name'])) {
                            foreach ($_FILES['files113']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT114 = $diemtcct->DiemTCCTAdd($c114, $lc114, $kc114, $idbd, 4);
                        if (isset($_FILES['files114']['name'])) {
                            foreach ($_FILES['files114']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT115 = $diemtcct->DiemTCCTAdd($c115, $lc115, $kc115, $idbd, 5);
                        if (isset($_FILES['files115']['name'])) {
                            foreach ($_FILES['files115']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT116 = $diemtcct->DiemTCCTAdd($c116, $lc116, $kc116, $idbd, 6);
                        if (isset($_FILES['files116']['name'])) {
                            foreach ($_FILES['files116']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT117 = $diemtcct->DiemTCCTAdd($c117, $lc117, $kc117, $idbd, 7);
                        if (isset($_FILES['files117']['name'])) {
                            foreach ($_FILES['files117']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT118 = $diemtcct->DiemTCCTAdd($c118, $lc118, $kc118, $idbd, 8);
                        if (isset($_FILES['files118']['name'])) {
                            foreach ($_FILES['files118']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT119 = $diemtcct->DiemTCCTAdd($c119, $lc119, $kc119, $idbd, 9);
                        $resultDTTCT121 = $diemtcct->DiemTCCTAdd($t121, $lt121, $kt121, $idbd, 10);
                        $resultDTTCT122 = $diemtcct->DiemTCCTAdd($t122, $lt122, $kt122, $idbd, 11);
                        // Diem TCCT2
                        $resultDTTCT211 = $diemtcct->DiemTCCTAdd($c211, $lc211, $kc211, $idbd, 12);
                        $resultDTTCT212 = $diemtcct->DiemTCCTAdd($c212, $lc211, $kc211, $idbd, 13);
                        $resultDTTCT221 = $diemtcct->DiemTCCTAdd($t221, $lt221, $kt221, $idbd, 14);
                        $resultDTTCT222 = $diemtcct->DiemTCCTAdd($t222, $lt222, $kt222, $idbd, 15);
                        $resultDTTCT223 = $diemtcct->DiemTCCTAdd($t223, $lt223, $kt223, $idbd, 16);
                        $resultDTTCT224 = $diemtcct->DiemTCCTAdd($t224, $lt224, $kt224, $idbd, 17);
                        $resultDTTCT225 = $diemtcct->DiemTCCTAdd($t225, $lt225, $kt225, $idbd, 18);
                        $resultDTTCT226 = $diemtcct->DiemTCCTAdd($t226, $lt226, $kt226, $idbd, 19);
                        $resultDTTCT227 = $diemtcct->DiemTCCTAdd($t227, $lt227, $kt227, $idbd, 20);
                        // DiemTCCT3
                        $resultDTTCT311 = $diemtcct->DiemTCCTAdd($c311, $lc311, $kc311, $idbd, 21);
                        if (isset($_FILES['files311']['name'])) {
                            foreach ($_FILES['files311']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT312 = $diemtcct->DiemTCCTAdd($c312, $lc312, $kc312, $idbd, 22);
                        if (isset($_FILES['files312']['name'])) {
                            foreach ($_FILES['files312']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT313 = $diemtcct->DiemTCCTAdd($c313, $lc313, $kc313, $idbd, 23);
                        if (isset($_FILES['files313']['name'])) {
                            foreach ($_FILES['files313']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT314 = $diemtcct->DiemTCCTAdd($c314, $lc314, $kc314, $idbd, 24);
                        if (isset($_FILES['files314']['name'])) {
                            foreach ($_FILES['files314']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT315 = $diemtcct->DiemTCCTAdd($c315, $lc315, $kc315, $idbd, 25);
                        if (isset($_FILES['files315']['name'])) {
                            foreach ($_FILES['files315']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT316 = $diemtcct->DiemTCCTAdd($c316, $lc316, $kc316, $idbd, 26);
                        if (isset($_FILES['files316']['name'])) {
                            foreach ($_FILES['files316']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT321 = $diemtcct->DiemTCCTAdd($t321, $lt321, $kt321, $idbd, 27);
                        $resultDTTCT322 = $diemtcct->DiemTCCTAdd($t322, $lt322, $kt322, $idbd, 28);
                        // DiemTCCT4
                        $resultDTTCT411 = $diemtcct->DiemTCCTAdd($c411, $lc411, $kc411, $idbd, 29);
                        $resultDTTCT412 = $diemtcct->DiemTCCTAdd($c412, $lc412, $kc412, $idbd, 30);
                        $resultDTTCT413 = $diemtcct->DiemTCCTAdd($c413, $lc413, $kc413, $idbd, 31);
                        $resultDTTCT414 = $diemtcct->DiemTCCTAdd($c414, $lc414, $kc414, $idbd, 32);
                        $resultDTTCT415 = $diemtcct->DiemTCCTAdd($c415, $lc415, $kc415, $idbd, 33);
                        $resultDTTCT416 = $diemtcct->DiemTCCTAdd($c416, $lc416, $kc416, $idbd, 34);
                        if (isset($_FILES['files416']['name'])) {
                            foreach ($_FILES['files416']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        // DiemTCCT5
                        $resultDTTCT511 = $diemtcct->DiemTCCTAdd($c511, $lc511, $kc511, $idbd, 35);
                        $resultDTTCT512 = $diemtcct->DiemTCCTAdd($c512, $lc512, $kc512, $idbd, 36);
                        if (isset($_FILES['files512']['name'])) {
                            foreach ($_FILES['files512']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT513 = $diemtcct->DiemTCCTAdd($c513, $lc513, $kc513, $idbd, 37);
                        if (isset($_FILES['files513']['name'])) {
                            foreach ($_FILES['files513']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT514 = $diemtcct->DiemTCCTAdd($c514, $lc514, $kc514, $idbd, 38);
                        if (isset($_FILES['files514']['name'])) {
                            foreach ($_FILES['files514']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT515 = $diemtcct->DiemTCCTAdd($c515, $lc515, $kc515, $idbd, 39);
                        if (isset($_FILES['files515']['name'])) {
                            foreach ($_FILES['files515']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT516 = $diemtcct->DiemTCCTAdd($c516, $lc516, $kc516, $idbd, 40);
                        if (isset($_FILES['files516']['name'])) {
                            foreach ($_FILES['files516']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT517 = $diemtcct->DiemTCCTAdd($c517, $lc517, $kc517, $idbd, 41);
                        if (isset($_FILES['files517']['name'])) {
                            foreach ($_FILES['files517']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT518 = $diemtcct->DiemTCCTAdd($c518, $lc518, $kc518, $idbd, 42);
                        if (isset($_FILES['files518']['name'])) {
                            foreach ($_FILES['files518']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        header('location:../../index.php?request=scoreView');
                    }
                    else{
                        $restBD = $bangdiem->BangdiemUpdate($getbdofsv->HOCKY, $getbdofsv->NAMHOC, $sum, $suml, $sumk, $getbdofsv->ID_SV, $getbdofsv->ID_BD);
                        $idbd = $getbdofsv->ID_BD;
                        // Diem TC
                        $resultDTC1 = $diemtc->DiemTCAdd($sum1, $suml1, $sumk1, $idbd, 1);   
                        $resultDTC2 = $diemtc->DiemTCAdd($sum2, $suml2, $sumk2, $idbd, 2);   
                        $resultDTC3 = $diemtc->DiemTCAdd($sum3, $suml3, $sumk3, $idbd, 3);   
                        $resultDTC4 = $diemtc->DiemTCAdd($sum4, $suml4, $sumk4, $idbd, 4);   
                        $resultDTC5 = $diemtc->DiemTCAdd($sum5, $suml5, $sumk5, $idbd, 5);   
                        // Diem TCCT1
                        $resultDTCCT111 = $diemtcct->DiemTCCTAdd($c111, $lc111, $kc111, $idbd, 1);
                        $resultDTTCT112 = $diemtcct->DiemTCCTAdd($c112, $lc112, $kc112, $idbd, 2);
                        $resultDTTCT113 = $diemtcct->DiemTCCTAdd($c113, $lc113, $kc113, $idbd, 3);
                        if (isset($_FILES['files113']['name'])) {
                            foreach ($_FILES['files113']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT114 = $diemtcct->DiemTCCTAdd($c114, $lc114, $kc114, $idbd, 4);
                        if (isset($_FILES['files114']['name'])) {
                            foreach ($_FILES['files114']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT115 = $diemtcct->DiemTCCTAdd($c115, $lc115, $kc115, $idbd, 5);
                        if (isset($_FILES['files115']['name'])) {
                            foreach ($_FILES['files115']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT116 = $diemtcct->DiemTCCTAdd($c116, $lc116, $kc116, $idbd, 6);
                        if (isset($_FILES['files116']['name'])) {
                            foreach ($_FILES['files116']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT117 = $diemtcct->DiemTCCTAdd($c117, $lc117, $kc117, $idbd, 7);
                        if (isset($_FILES['files117']['name'])) {
                            foreach ($_FILES['files117']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT118 = $diemtcct->DiemTCCTAdd($c118, $lc118, $kc118, $idbd, 8);
                        if (isset($_FILES['files118']['name'])) {
                            foreach ($_FILES['files118']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT119 = $diemtcct->DiemTCCTAdd($c119, $lc119, $kc119, $idbd, 9);
                        $resultDTTCT121 = $diemtcct->DiemTCCTAdd($t121, $lt121, $kt121, $idbd, 10);
                        $resultDTTCT122 = $diemtcct->DiemTCCTAdd($t122, $lt122, $kt122, $idbd, 11);
                        // Diem TCCT2
                        $resultDTTCT211 = $diemtcct->DiemTCCTAdd($c211, $lc211, $kc211, $idbd, 12);
                        $resultDTTCT212 = $diemtcct->DiemTCCTAdd($c212, $lc211, $kc211, $idbd, 13);
                        $resultDTTCT221 = $diemtcct->DiemTCCTAdd($t221, $lt221, $kt221, $idbd, 14);
                        $resultDTTCT222 = $diemtcct->DiemTCCTAdd($t222, $lt222, $kt222, $idbd, 15);
                        $resultDTTCT223 = $diemtcct->DiemTCCTAdd($t223, $lt223, $kt223, $idbd, 16);
                        $resultDTTCT224 = $diemtcct->DiemTCCTAdd($t224, $lt224, $kt224, $idbd, 17);
                        $resultDTTCT225 = $diemtcct->DiemTCCTAdd($t225, $lt225, $kt225, $idbd, 18);
                        $resultDTTCT226 = $diemtcct->DiemTCCTAdd($t226, $lt226, $kt226, $idbd, 19);
                        $resultDTTCT227 = $diemtcct->DiemTCCTAdd($t227, $lt227, $kt227, $idbd, 20);
                        // DiemTCCT3
                        $resultDTTCT311 = $diemtcct->DiemTCCTAdd($c311, $lc311, $kc311, $idbd, 21);
                        if (isset($_FILES['files311']['name'])) {
                            foreach ($_FILES['files311']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT312 = $diemtcct->DiemTCCTAdd($c312, $lc312, $kc312, $idbd, 22);
                        if (isset($_FILES['files312']['name'])) {
                            foreach ($_FILES['files312']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT313 = $diemtcct->DiemTCCTAdd($c313, $lc313, $kc313, $idbd, 23);
                        if (isset($_FILES['files313']['name'])) {
                            foreach ($_FILES['files313']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT314 = $diemtcct->DiemTCCTAdd($c314, $lc314, $kc314, $idbd, 24);
                        if (isset($_FILES['files314']['name'])) {
                            foreach ($_FILES['files314']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT315 = $diemtcct->DiemTCCTAdd($c315, $lc315, $kc315, $idbd, 25);
                        if (isset($_FILES['files315']['name'])) {
                            foreach ($_FILES['files315']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT316 = $diemtcct->DiemTCCTAdd($c316, $lc316, $kc316, $idbd, 26);
                        if (isset($_FILES['files316']['name'])) {
                            foreach ($_FILES['files316']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT321 = $diemtcct->DiemTCCTAdd($t321, $lt321, $kt321, $idbd, 27);
                        $resultDTTCT322 = $diemtcct->DiemTCCTAdd($t322, $lt322, $kt322, $idbd, 28);
                        // DiemTCCT4
                        $resultDTTCT411 = $diemtcct->DiemTCCTAdd($c411, $lc411, $kc411, $idbd, 29);
                        $resultDTTCT412 = $diemtcct->DiemTCCTAdd($c412, $lc412, $kc412, $idbd, 30);
                        $resultDTTCT413 = $diemtcct->DiemTCCTAdd($c413, $lc413, $kc413, $idbd, 31);
                        $resultDTTCT414 = $diemtcct->DiemTCCTAdd($c414, $lc414, $kc414, $idbd, 32);
                        $resultDTTCT415 = $diemtcct->DiemTCCTAdd($c415, $lc415, $kc415, $idbd, 33);
                        $resultDTTCT416 = $diemtcct->DiemTCCTAdd($c416, $lc416, $kc416, $idbd, 34);
                        if (isset($_FILES['files416']['name'])) {
                            foreach ($_FILES['files416']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        // DiemTCCT5
                        $resultDTTCT511 = $diemtcct->DiemTCCTAdd($c511, $lc511, $kc511, $idbd, 35);
                        $resultDTTCT512 = $diemtcct->DiemTCCTAdd($c512, $lc512, $kc512, $idbd, 36);
                        if (isset($_FILES['files512']['name'])) {
                            foreach ($_FILES['files512']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT513 = $diemtcct->DiemTCCTAdd($c513, $lc513, $kc513, $idbd, 37);
                        if (isset($_FILES['files513']['name'])) {
                            foreach ($_FILES['files513']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT514 = $diemtcct->DiemTCCTAdd($c514, $lc514, $kc514, $idbd, 38);
                        if (isset($_FILES['files514']['name'])) {
                            foreach ($_FILES['files514']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT515 = $diemtcct->DiemTCCTAdd($c515, $lc515, $kc515, $idbd, 39);
                        if (isset($_FILES['files515']['name'])) {
                            foreach ($_FILES['files515']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT516 = $diemtcct->DiemTCCTAdd($c516, $lc516, $kc516, $idbd, 40);
                        if (isset($_FILES['files516']['name'])) {
                            foreach ($_FILES['files516']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT517 = $diemtcct->DiemTCCTAdd($c517, $lc517, $kc517, $idbd, 41);
                        if (isset($_FILES['files517']['name'])) {
                            foreach ($_FILES['files517']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT518 = $diemtcct->DiemTCCTAdd($c518, $lc518, $kc518, $idbd, 42);
                        if (isset($_FILES['files518']['name'])) {
                            foreach ($_FILES['files518']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        header('location:../../index.php?request=scoreView');
                    }
                }
                else if(isset($_SESSION['BCS'])){
                    // Phan 1
                    // Sinhvien
                    $c111 = $_POST['sv-111']; $c112 = $_POST['sv-112']; $c113 = $_POST['sv-113']; $c114 = $_POST['sv-114']; $c115 = $_POST['sv-115'];
                    $c116 = $_POST['sv-116']; $c117 = $_POST['sv-117']; $c118 = $_POST['sv-118']; $c119 = $_POST['sv-119'];
                    $t121 = $_POST['sv-121']; $t122 = $_POST['sv-122'];
                    $sum1 = (int)$c111 + (int)$c112 + (int)$c113 + (int)$c114 + (int)$c115 + (int)$c116 + (int)$c117 + (int)$c118 + (int)$c119 - (int)$t121 - (int)$t121;
                    // Lop
                    $lc111 = $_POST['lop-111']; $lc112 = $_POST['lop-112']; $lc113 = $_POST['lop-113']; $lc114 = $_POST['lop-114']; $lc115 = $_POST['lop-115'];
                    $lc116 = $_POST['lop-116']; $lc117 = $_POST['lop-117']; $lc118 = $_POST['lop-118']; $lc119 = $_POST['lop-119'];
                    $lt121 = $_POST['lop-121']; $lt122 = $_POST['lop-122'];
                    $suml1 = (int)$lc111 + (int)$lc112 + (int)$lc113 + (int)$lc114 + (int)$lc115 + (int)$lc116 + (int)$lc117 + (int)$lc118 + (int)$lc119 - (int)$lt121 - (int)$lt121;
                    
                    if (isset($_FILES['files113']['name'])) {
                        foreach ($_FILES['files113']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum1 -= (int)$c113; 
                                $suml1 -= (int)$lc113;        
                                $c113 = 0;
                                $lc113 = 0;
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
                                $suml1 -= (int)$lc114;
                                $c114 = 0;
                                $lc114 = 0;
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
                                $suml1 -= (int)$lc115;
                                $c115 = 0;
                                $lc115 = 0;
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
                                $suml1 -= (int)$lc116;
                                $c116 = 0;
                                $lc116 = 0;
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
                                $suml1 -= (int)$lc117;
                                $c117 = 0;
                                $lc117 = 0;
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
                                $suml1 -= (int)$lc118;
                                $c118 = 0;
                                $lc118 = 0;
                            }
                        }
                    }
                    if($sum1 > 20){
                        $sum1 = 20;
                    }
                    if($suml1 > 20){
                        $suml1 = 20;
                    }

                    // Phan 2
                    // Sinhvien
                    $c211 = $_POST['sv-211']; $c212 = $_POST['sv-212'];
                    $t221 = $_POST['sv-221']; $t222 = $_POST['sv-222']; $t223 = $_POST['sv-223']; $t224 = $_POST['sv-224']; $t225 = $_POST['sv-225'];
                    $t226 = $_POST['sv-226']; $t227 = $_POST['sv-227'];
                    $sum2 = (int)$c211 + (int)$c212 - (int)$t221 - (int)$t222 - (int)$t223 - (int)$t224 - (int)$t225 - (int)$t226 - (int)$t227;
                    // Lop
                    $lc211 = $_POST['lop-211']; $lc212 = $_POST['lop-212'];
                    $lt221 = $_POST['lop-221']; $lt222 = $_POST['lop-222']; $lt223 = $_POST['lop-223']; $lt224 = $_POST['lop-224']; $lt225 = $_POST['lop-225'];
                    $lt226 = $_POST['lop-226']; $lt227 = $_POST['lop-227'];
                    $suml2 = (int)$lc211 + (int)$lc212 - (int)$lt221 - (int)$lt222 - (int)$lt223 - (int)$lt224 - (int)$lt225 - (int)$lt226 - (int)$lt227;
            
                    if($sum2 > 25){
                        $sum2 = 25;
                    }
                    if($suml2 > 25){
                        $suml2 = 25;
                    }

                    // Phan 3
                    // Sinh vien
                    $c311 = $_POST['sv-311']; $c312 = $_POST['sv-312']; $c313 = $_POST['sv-313']; $c314 = $_POST['sv-314']; $c315 = $_POST['sv-315'];
                    $c316 = $_POST['sv-316'];
                    $t321 = $_POST['sv-321']; $t322 = $_POST['sv-322'];
                    $sum3 = (int)$c311 + (int)$c312 + (int)$c313 + (int)$c314 + (int)$c315 + (int)$c316 - (int)$t321 - (int)$t322;
                    // Lop
                    $lc311 = $_POST['lop-311']; $lc312 = $_POST['lop-312']; $lc313 = $_POST['lop-313']; $lc314 = $_POST['lop-314']; $lc315 = $_POST['lop-315'];
                    $lc316 = $_POST['lop-316'];
                    $lt321 = $_POST['lop-321']; $lt322 = $_POST['lop-322'];
                    $suml3 = (int)$lc311 + (int)$lc312 + (int)$lc313 + (int)$lc314 + (int)$lc315 + (int)$lc316 - (int)$lt321 - (int)$lt322;

                    if (isset($_FILES['files311']['name'])) {
                        foreach ($_FILES['files311']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum3 -= (int)$c311;
                                $suml3 -= (int)$lc311;
                                $c311 = 0;
                                $lc311 = 0;
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
                                $suml3 -= (int)$lc312;
                                $c312 = 0;
                                $lc312 = 0;
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
                                $suml3 -= (int)$lc313;
                                $c313 = 0;
                                $lc313 = 0;
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
                                $suml3 -= (int)$lc314;
                                $c314 = 0;
                                $lc314 = 0;
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
                                $suml3 -= (int)$lc315;
                                $c315 = 0;
                                $lc315 = 0;
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
                                $suml3 -= (int)$lc316;
                                $c316 = 0;
                                $lc316 = 0;
                            }
                        }
                    }
                    if($sum3 > 20){
                        $sum3 = 20;
                    }
                    if($suml3 > 20){
                        $suml3 = 20;
                    }

                    // Phan 4
                    // Sinhvien
                    $c411 = $_POST['sv-411']; $c412 = $_POST['sv-412']; $c413 = $_POST['sv-413']; $c414 = $_POST['sv-414']; $c415 = $_POST['sv-415'];
                    $c416 = $_POST['sv-416'];
                    $sum4 = (int)$c411 + (int)$c412 + (int)$c413 + (int)$c414 + (int)$c415 + (int)$c416;
                    // Lop
                    $lc411 = $_POST['lop-411']; $lc412 = $_POST['lop-412']; $lc413 = $_POST['lop-413']; $lc414 = $_POST['lop-414']; $lc415 = $_POST['lop-415'];
                    $lc416 = $_POST['lop-416'];
                    $suml4 = (int)$lc411 + (int)$lc412 + (int)$lc413 + (int)$lc414 + (int)$lc415 + (int)$lc416;

                    if (isset($_FILES['files416']['name'])) {
                        foreach ($_FILES['files416']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum4 -= (int)$c416;
                                $suml4 -= (int)$lc416;
                                $c416 = 0;
                                $lc416 = 0;
                            }
                        }
                    }
                    if($sum4 > 25){
                        $sum4 = 25;
                    }
                    if($suml4 > 25){
                        $suml4 = 25;
                    }

                    // Phan 5
                    // Sinhvien
                    $c511 = $_POST['sv-511']; $c512 = $_POST['sv-512']; $c513 = $_POST['sv-513']; $c514 = $_POST['sv-514']; $c515 = $_POST['sv-515'];
                    $c516 = $_POST['sv-516']; $c517 = $_POST['sv-517']; $c518 = $_POST['sv-518'];
                    $sum5 = (int)$c511 + (int)$c512 + (int)$c513 + (int)$c514 + (int)$c515 + (int)$c516 + (int)$c517 + (int)$c518;
                    // Lop
                    $lc511 = $_POST['lop-511']; $lc512 = $_POST['lop-512']; $lc513 = $_POST['lop-513']; $lc514 = $_POST['lop-514']; $lc515 = $_POST['lop-515'];
                    $lc516 = $_POST['lop-516']; $lc517 = $_POST['lop-517']; $lc518 = $_POST['lop-518'];
                    $suml5 = (int)$lc511 + (int)$lc512 + (int)$lc513 + (int)$lc514 + (int)$lc515 + (int)$lc516 + (int)$lc517 + (int)$lc518;

                    if (isset($_FILES['files512']['name'])) {
                        foreach ($_FILES['files512']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);

                            } else {
                                $sum5 -= (int)$c512;
                                $suml5 -= (int)$lc512;
                                $c512 = 0;
                                $lc512 = 0;
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
                                $suml5 -= (int)$lc513;
                                $c513 = 0;
                                $lc513 = 0;
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
                                $suml5 -= (int)$lc514;
                                $c514 = 0;
                                $lc514 = 0;
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
                                $suml5 -= (int)$lc515;
                                $c515 = 0;
                                $lc515 = 0;
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
                                $suml5 -= (int)$lc516;
                                $c516 = 0;
                                $lc516 = 0;
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
                                $suml5 -= (int)$lc517;
                                $c517 = 0;
                                $lc517 = 0;
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
                                $suml5 -= (int)$lc518;
                                $c518 = 0;
                                $lc518 = 0;
                            }
                        }
                    }
                    if($sum5 > 10){
                        $sum5 = 10;
                    }
                    if($suml5 > 10){
                        $suml5 = 10;
                    }

                    // Tong
                    $sum = (int)$sum1 + (int)$sum2 + (int)$sum3 + (int)$sum4 + (int)$sum5;
                    $suml = (int)$suml1 + (int)$suml2 + (int)$suml3 + (int)$suml4 + (int)$suml5;

                    $bangdiem = new Bangdiem();
                    $diemtc = new DiemTC();
                    $diemtcct = new DiemTCCT();
                    $getcheck = $bangdiem->BangdiemGetbyCheckBoth(1, 1);

                    $resultBD = $bangdiem->BangdiemAdd($getcheck->HOCKY, $getcheck->NAMHOC, $sum, $suml, null, $idsv, $getcheck->TUNGAY, $getcheck->DENNGAY);
                    $idbd = ($bangdiem->BangdiemLastOfIDSV($idsv))->ID_BD;
                    // Diem TC
                    $resultDTC1 = $diemtc->DiemTCAdd($sum1, $suml1, null, $idbd, 1);   
                    $resultDTC2 = $diemtc->DiemTCAdd($sum2, $suml2, null, $idbd, 2);   
                    $resultDTC3 = $diemtc->DiemTCAdd($sum3, $suml3, null, $idbd, 3);   
                    $resultDTC4 = $diemtc->DiemTCAdd($sum4, $suml4, null, $idbd, 4);   
                    $resultDTC5 = $diemtc->DiemTCAdd($sum5, $suml5, null, $idbd, 5);   
                    // Diem TCCT1
                    $resultDTCCT111 = $diemtcct->DiemTCCTAdd($c111, $lc111, null, $idbd, 1);
                    $resultDTTCT112 = $diemtcct->DiemTCCTAdd($c112, $lc112, null, $idbd, 2);
                    $resultDTTCT113 = $diemtcct->DiemTCCTAdd($c113, $lc113, null, $idbd, 3);
                    if (isset($_FILES['files113']['name'])) {
                        foreach ($_FILES['files113']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT114 = $diemtcct->DiemTCCTAdd($c114, $lc114, null, $idbd, 4);
                    if (isset($_FILES['files114']['name'])) {
                        foreach ($_FILES['files114']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT115 = $diemtcct->DiemTCCTAdd($c115, $lc115, null, $idbd, 5);
                    if (isset($_FILES['files115']['name'])) {
                        foreach ($_FILES['files115']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT116 = $diemtcct->DiemTCCTAdd($c116, $lc116, null, $idbd, 6);
                    if (isset($_FILES['files116']['name'])) {
                        foreach ($_FILES['files116']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT117 = $diemtcct->DiemTCCTAdd($c117, $lc117, null, $idbd, 7);
                    if (isset($_FILES['files117']['name'])) {
                        foreach ($_FILES['files117']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT118 = $diemtcct->DiemTCCTAdd($c118, $lc118, null, $idbd, 8);
                    if (isset($_FILES['files118']['name'])) {
                        foreach ($_FILES['files118']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT119 = $diemtcct->DiemTCCTAdd($c119, $lc119, null, $idbd, 9);
                    $resultDTTCT121 = $diemtcct->DiemTCCTAdd($t121, $lt121, null, $idbd, 10);
                    $resultDTTCT122 = $diemtcct->DiemTCCTAdd($t122, $lt122, null, $idbd, 11);
                    // Diem TCCT2
                    $resultDTTCT211 = $diemtcct->DiemTCCTAdd($c211, $lc211, null, $idbd, 12);
                    $resultDTTCT212 = $diemtcct->DiemTCCTAdd($c212, $lc211, null, $idbd, 13);
                    $resultDTTCT221 = $diemtcct->DiemTCCTAdd($t221, $lt221, null, $idbd, 14);
                    $resultDTTCT222 = $diemtcct->DiemTCCTAdd($t222, $lt222, null, $idbd, 15);
                    $resultDTTCT223 = $diemtcct->DiemTCCTAdd($t223, $lt223, null, $idbd, 16);
                    $resultDTTCT224 = $diemtcct->DiemTCCTAdd($t224, $lt224, null, $idbd, 17);
                    $resultDTTCT225 = $diemtcct->DiemTCCTAdd($t225, $lt225, null, $idbd, 18);
                    $resultDTTCT226 = $diemtcct->DiemTCCTAdd($t226, $lt226, null, $idbd, 19);
                    $resultDTTCT227 = $diemtcct->DiemTCCTAdd($t227, $lt227, null, $idbd, 20);
                    // DiemTCCT3
                    $resultDTTCT311 = $diemtcct->DiemTCCTAdd($c311, $lc311, null, $idbd, 21);
                    if (isset($_FILES['files311']['name'])) {
                        foreach ($_FILES['files311']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT312 = $diemtcct->DiemTCCTAdd($c312, $lc312, null, $idbd, 22);
                    if (isset($_FILES['files312']['name'])) {
                        foreach ($_FILES['files312']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT313 = $diemtcct->DiemTCCTAdd($c313, $lc313, null, $idbd, 23);
                    if (isset($_FILES['files313']['name'])) {
                        foreach ($_FILES['files313']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT314 = $diemtcct->DiemTCCTAdd($c314, $lc314, null, $idbd, 24);
                    if (isset($_FILES['files314']['name'])) {
                        foreach ($_FILES['files314']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT315 = $diemtcct->DiemTCCTAdd($c315, $lc315, null, $idbd, 25);
                    if (isset($_FILES['files315']['name'])) {
                        foreach ($_FILES['files315']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT316 = $diemtcct->DiemTCCTAdd($c316, $lc316, null, $idbd, 26);
                    if (isset($_FILES['files316']['name'])) {
                        foreach ($_FILES['files316']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT321 = $diemtcct->DiemTCCTAdd($t321, $lt321, null, $idbd, 27);
                    $resultDTTCT322 = $diemtcct->DiemTCCTAdd($t322, $lt322, null, $idbd, 28);
                    // DiemTCCT4
                    $resultDTTCT411 = $diemtcct->DiemTCCTAdd($c411, $lc411, null, $idbd, 29);
                    $resultDTTCT412 = $diemtcct->DiemTCCTAdd($c412, $lc412, null, $idbd, 30);
                    $resultDTTCT413 = $diemtcct->DiemTCCTAdd($c413, $lc413, null, $idbd, 31);
                    $resultDTTCT414 = $diemtcct->DiemTCCTAdd($c414, $lc414, null, $idbd, 32);
                    $resultDTTCT415 = $diemtcct->DiemTCCTAdd($c415, $lc415, null, $idbd, 33);
                    $resultDTTCT416 = $diemtcct->DiemTCCTAdd($c416, $lc416, null, $idbd, 34);
                    if (isset($_FILES['files416']['name'])) {
                        foreach ($_FILES['files416']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    // DiemTCCT5
                    $resultDTTCT511 = $diemtcct->DiemTCCTAdd($c511, $lc511, null, $idbd, 35);
                    $resultDTTCT512 = $diemtcct->DiemTCCTAdd($c512, $lc512, null, $idbd, 36);
                    if (isset($_FILES['files512']['name'])) {
                        foreach ($_FILES['files512']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT513 = $diemtcct->DiemTCCTAdd($c513, $lc513, null, $idbd, 37);
                    if (isset($_FILES['files513']['name'])) {
                        foreach ($_FILES['files513']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT514 = $diemtcct->DiemTCCTAdd($c514, $lc514, null, $idbd, 38);
                    if (isset($_FILES['files514']['name'])) {
                        foreach ($_FILES['files514']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT515 = $diemtcct->DiemTCCTAdd($c515, $lc515, null, $idbd, 39);
                    if (isset($_FILES['files515']['name'])) {
                        foreach ($_FILES['files515']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT516 = $diemtcct->DiemTCCTAdd($c516, $lc516, null, $idbd, 40);
                    if (isset($_FILES['files516']['name'])) {
                        foreach ($_FILES['files516']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT517 = $diemtcct->DiemTCCTAdd($c517, $lc517, null, $idbd, 41);
                    if (isset($_FILES['files517']['name'])) {
                        foreach ($_FILES['files517']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    $resultDTTCT518 = $diemtcct->DiemTCCTAdd($c518, $lc518, null, $idbd, 42);
                    if (isset($_FILES['files518']['name'])) {
                        foreach ($_FILES['files518']['tmp_name'] as $key => $tmp_name) {
                            if (!empty($tmp_name)) {
                                $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                $minhchung = new Minhchung();
                                $hinhanh = file_get_contents($tmp_name);
                                $hinhanh = base64_encode($hinhanh);
                                $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                            } else {
                                
                            }
                        }
                    }
                    header('location:../../index.php?request=scoreView');
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
                                $c113 = 0;
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
                                $c114 = 0;
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
                                $c115 = 0;
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
                                $c116 = 0;
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
                                $c117 = 0;
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
                                $c118 = 0;
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
                                $c311 = 0;
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
                                $c312 = 0;
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
                                $c313 = 0;
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
                                $c314 = 0;
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
                                $c315 = 0;
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
                                $c316 = 0;
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
                                $c416 = 0;
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
                                $c512 = 0;
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
                                $c513 = 0;
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
                                $c514 = 0;
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
                                $c515 = 0;
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
                                $c516 = 0;
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
                                $c517 = 0;
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
                                $c518 = 0;
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
                    if($getcheck != null){

                        $resultBD = $bangdiem->BangdiemAdd($getcheck->HOCKY, $getcheck->NAMHOC, $sum, null, null, $idsv, $getcheck->TUNGAY, $getcheck->DENNGAY);
                        $idbd = ($bangdiem->BangdiemLastOfIDSV($idsv))->ID_BD;
                        // Diem TC
                        $resultDTC1 = $diemtc->DiemTCAdd($sum1, null, null, $idbd, 1);   
                        $resultDTC2 = $diemtc->DiemTCAdd($sum2, null, null, $idbd, 2);   
                        $resultDTC3 = $diemtc->DiemTCAdd($sum3, null, null, $idbd, 3);   
                        $resultDTC4 = $diemtc->DiemTCAdd($sum4, null, null, $idbd, 4);   
                        $resultDTC5 = $diemtc->DiemTCAdd($sum5, null, null, $idbd, 5);   
                        // Diem TCCT1
                        $resultDTCCT111 = $diemtcct->DiemTCCTAdd($c111, null, null, $idbd, 1);
                        $resultDTTCT112 = $diemtcct->DiemTCCTAdd($c112, null, null, $idbd, 2);
                        $resultDTTCT113 = $diemtcct->DiemTCCTAdd($c113, null, null, $idbd, 3);
                        if (isset($_FILES['files113']['name'])) {
                            foreach ($_FILES['files113']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT114 = $diemtcct->DiemTCCTAdd($c114, null, null, $idbd, 4);
                        if (isset($_FILES['files114']['name'])) {
                            foreach ($_FILES['files114']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT115 = $diemtcct->DiemTCCTAdd($c115, null, null, $idbd, 5);
                        if (isset($_FILES['files115']['name'])) {
                            foreach ($_FILES['files115']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT116 = $diemtcct->DiemTCCTAdd($c116, null, null, $idbd, 6);
                        if (isset($_FILES['files116']['name'])) {
                            foreach ($_FILES['files116']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT117 = $diemtcct->DiemTCCTAdd($c117, null, null, $idbd, 7);
                        if (isset($_FILES['files117']['name'])) {
                            foreach ($_FILES['files117']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT118 = $diemtcct->DiemTCCTAdd($c118, null, null, $idbd, 8);
                        if (isset($_FILES['files118']['name'])) {
                            foreach ($_FILES['files118']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT119 = $diemtcct->DiemTCCTAdd($c119, null, null, $idbd, 9);
                        $resultDTTCT121 = $diemtcct->DiemTCCTAdd($t121, null, null, $idbd, 10);
                        $resultDTTCT122 = $diemtcct->DiemTCCTAdd($t122, null, null, $idbd, 11);
                        // Diem TCCT2
                        $resultDTTCT211 = $diemtcct->DiemTCCTAdd($c211, null, null, $idbd, 12);
                        $resultDTTCT212 = $diemtcct->DiemTCCTAdd($c212, null, null, $idbd, 13);
                        $resultDTTCT221 = $diemtcct->DiemTCCTAdd($t221, null, null, $idbd, 14);
                        $resultDTTCT222 = $diemtcct->DiemTCCTAdd($t222, null, null, $idbd, 15);
                        $resultDTTCT223 = $diemtcct->DiemTCCTAdd($t223, null, null, $idbd, 16);
                        $resultDTTCT224 = $diemtcct->DiemTCCTAdd($t224, null, null, $idbd, 17);
                        $resultDTTCT225 = $diemtcct->DiemTCCTAdd($t225, null, null, $idbd, 18);
                        $resultDTTCT226 = $diemtcct->DiemTCCTAdd($t226, null, null, $idbd, 19);
                        $resultDTTCT227 = $diemtcct->DiemTCCTAdd($t227, null, null, $idbd, 20);
                        // DiemTCCT3
                        $resultDTTCT311 = $diemtcct->DiemTCCTAdd($c311, null, null, $idbd, 21);
                        if (isset($_FILES['files311']['name'])) {
                            foreach ($_FILES['files311']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT312 = $diemtcct->DiemTCCTAdd($c312, null, null, $idbd, 22);
                        if (isset($_FILES['files312']['name'])) {
                            foreach ($_FILES['files312']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT313 = $diemtcct->DiemTCCTAdd($c313, null, null, $idbd, 23);
                        if (isset($_FILES['files313']['name'])) {
                            foreach ($_FILES['files313']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT314 = $diemtcct->DiemTCCTAdd($c314, null, null, $idbd, 24);
                        if (isset($_FILES['files314']['name'])) {
                            foreach ($_FILES['files314']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT315 = $diemtcct->DiemTCCTAdd($c315, null, null, $idbd, 25);
                        if (isset($_FILES['files315']['name'])) {
                            foreach ($_FILES['files315']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT316 = $diemtcct->DiemTCCTAdd($c316, null, null, $idbd, 26);
                        if (isset($_FILES['files316']['name'])) {
                            foreach ($_FILES['files316']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT321 = $diemtcct->DiemTCCTAdd($t321, null, null, $idbd, 27);
                        $resultDTTCT322 = $diemtcct->DiemTCCTAdd($t322, null, null, $idbd, 28);
                        // DiemTCCT4
                        $resultDTTCT411 = $diemtcct->DiemTCCTAdd($c411, null, null, $idbd, 29);
                        $resultDTTCT412 = $diemtcct->DiemTCCTAdd($c412, null, null, $idbd, 30);
                        $resultDTTCT413 = $diemtcct->DiemTCCTAdd($c413, null, null, $idbd, 31);
                        $resultDTTCT414 = $diemtcct->DiemTCCTAdd($c414, null, null, $idbd, 32);
                        $resultDTTCT415 = $diemtcct->DiemTCCTAdd($c415, null, null, $idbd, 33);
                        $resultDTTCT416 = $diemtcct->DiemTCCTAdd($c416, null, null, $idbd, 34);
                        if (isset($_FILES['files416']['name'])) {
                            foreach ($_FILES['files416']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        // DiemTCCT5
                        $resultDTTCT511 = $diemtcct->DiemTCCTAdd($c511, null, null, $idbd, 35);
                        $resultDTTCT512 = $diemtcct->DiemTCCTAdd($c512, null, null, $idbd, 36);
                        if (isset($_FILES['files512']['name'])) {
                            foreach ($_FILES['files512']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT513 = $diemtcct->DiemTCCTAdd($c513, null, null, $idbd, 37);
                        if (isset($_FILES['files513']['name'])) {
                            foreach ($_FILES['files513']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT514 = $diemtcct->DiemTCCTAdd($c514, null, null, $idbd, 38);
                        if (isset($_FILES['files514']['name'])) {
                            foreach ($_FILES['files514']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT515 = $diemtcct->DiemTCCTAdd($c515, null, null, $idbd, 39);
                        if (isset($_FILES['files515']['name'])) {
                            foreach ($_FILES['files515']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT516 = $diemtcct->DiemTCCTAdd($c516, null, null, $idbd, 40);
                        if (isset($_FILES['files516']['name'])) {
                            foreach ($_FILES['files516']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT517 = $diemtcct->DiemTCCTAdd($c517, null, null, $idbd, 41);
                        if (isset($_FILES['files517']['name'])) {
                            foreach ($_FILES['files517']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        $resultDTTCT518 = $diemtcct->DiemTCCTAdd($c518, null, null, $idbd, 42);
                        if (isset($_FILES['files518']['name'])) {
                            foreach ($_FILES['files518']['tmp_name'] as $key => $tmp_name) {
                                if (!empty($tmp_name)) {
                                    $IDDTCCTLast = ($diemtcct->DiemTCCTLast())->ID_DTCCT;
                                    $minhchung = new Minhchung();
                                    $hinhanh = file_get_contents($tmp_name);
                                    $hinhanh = base64_encode($hinhanh);
                                    $resultHA = $minhchung->MinhchungAdd($hinhanh,$IDDTCCTLast);
                                } else {
                                    
                                }
                            }
                        }
                        header('location:../../index.php?request=scoreView');
                    }
                    else{
                        echo "Chưa mở bảng điểm";
                    }
                }

                break;
            case 'updateByBCS':
                $idbd = $_GET['idbd'];

                $lc111 = $_POST['lop-111']; $lc112 = $_POST['lop-112']; $lc113 = $_POST['lop-113']; $lc114 = $_POST['lop-114']; $lc115 = $_POST['lop-115'];
                $lc116 = $_POST['lop-116']; $lc117 = $_POST['lop-117']; $lc118 = $_POST['lop-118']; $lc119 = $_POST['lop-119'];
                $lt121 = $_POST['lop-121']; $lt122 = $_POST['lop-122'];
                $suml1 = (int)$lc111 + (int)$lc112 + (int)$lc113 + (int)$lc114 + (int)$lc115 + (int)$lc116 + (int)$lc117 + (int)$lc118 + (int)$lc119 - (int)$lt121 - (int)$lt121;


                $lc211 = $_POST['lop-211']; $lc212 = $_POST['lop-212'];
                $lt221 = $_POST['lop-221']; $lt222 = $_POST['lop-222']; $lt223 = $_POST['lop-223']; $lt224 = $_POST['lop-224']; $lt225 = $_POST['lop-225'];
                $lt226 = $_POST['lop-226']; $lt227 = $_POST['lop-227'];
                $suml2 = (int)$lc211 + (int)$lc212 - (int)$lt221 - (int)$lt222 - (int)$lt223 - (int)$lt224 - (int)$lt225 - (int)$lt226 - (int)$lt227;

                
                $lc311 = $_POST['lop-311']; $lc312 = $_POST['lop-312']; $lc313 = $_POST['lop-313']; $lc314 = $_POST['lop-314']; $lc315 = $_POST['lop-315'];
                $lc316 = $_POST['lop-316'];
                $lt321 = $_POST['lop-321']; $lt322 = $_POST['lop-322'];
                $suml3 = (int)$lc311 + (int)$lc312 + (int)$lc313 + (int)$lc314 + (int)$lc315 + (int)$lc316 - (int)$lt321 - (int)$lt322;  
                
                
                $lc411 = $_POST['lop-411']; $lc412 = $_POST['lop-412']; $lc413 = $_POST['lop-413']; $lc414 = $_POST['lop-414']; $lc415 = $_POST['lop-415'];
                $lc416 = $_POST['lop-416'];
                $suml4 = (int)$lc411 + (int)$lc412 + (int)$lc413 + (int)$lc414 + (int)$lc415 + (int)$lc416;

                
                $lc511 = $_POST['lop-511']; $lc512 = $_POST['lop-512']; $lc513 = $_POST['lop-513']; $lc514 = $_POST['lop-514']; $lc515 = $_POST['lop-515'];
                $lc516 = $_POST['lop-516']; $lc517 = $_POST['lop-517']; $lc518 = $_POST['lop-518'];
                $suml5 = (int)$lc511 + (int)$lc512 + (int)$lc513 + (int)$lc514 + (int)$lc515 + (int)$lc516 + (int)$lc517 + (int)$lc518;

                if($suml1 > 20){
                    $suml1 = 20;
                }
                if($suml2 > 25){
                    $suml2 = 25;
                }
                if($suml3 > 20){
                    $suml3 = 20;
                }
                if($suml4 > 25){
                    $suml4 = 25;
                }
                if($suml5 > 10){
                    $suml5 = 10;
                }

                $sum = $suml1 + $suml2 + $suml3 + $suml4 + $suml5;
                
                $bangdiem = new Bangdiem();
                $getbangdiem = $bangdiem->BangdiemGetbyId($idbd);
                $resultBD = $bangdiem->BangdiemUpdateTONGDIEMLOP($sum, $idbd);

                $diemtc = new DiemTC();
                $getallDTC = $diemtc->DiemTCGetbyIdBD($idbd);
                foreach($getallDTC as $dtc){
                    if($dtc->ID_TC == 1){ $result = $diemtc->DiemTCUpdateTONGDIEMLOP($suml1, $dtc->ID_DTC); }
                    if($dtc->ID_TC == 2){ $result = $diemtc->DiemTCUpdateTONGDIEMLOP($suml2, $dtc->ID_DTC); }
                    if($dtc->ID_TC == 3){ $result = $diemtc->DiemTCUpdateTONGDIEMLOP($suml3, $dtc->ID_DTC); }
                    if($dtc->ID_TC == 4){ $result = $diemtc->DiemTCUpdateTONGDIEMLOP($suml4, $dtc->ID_DTC); }
                    if($dtc->ID_TC == 5){ $result = $diemtc->DiemTCUpdateTONGDIEMLOP($suml5, $dtc->ID_DTC); }
                }

                $diemtcct = new DiemTCCT();
                $getAllDTCCT = $diemtcct->DiemTCCTGetbyIdBD($idbd);
                $count = 0;
                foreach($getAllDTCCT as $dtcct){
                    $count++;
                    if($count==1){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc111, $dtcct->ID_DTCCT); }
                    if($count==2){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc112, $dtcct->ID_DTCCT); }
                    if($count==3){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc113, $dtcct->ID_DTCCT); }
                    if($count==4){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc114, $dtcct->ID_DTCCT); }
                    if($count==5){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc115, $dtcct->ID_DTCCT); }
                    if($count==6){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc116, $dtcct->ID_DTCCT); }
                    if($count==7){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc117, $dtcct->ID_DTCCT); }
                    if($count==8){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc118, $dtcct->ID_DTCCT); }
                    if($count==9){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc119, $dtcct->ID_DTCCT); }
                    if($count==10){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt121, $dtcct->ID_DTCCT); }
                    if($count==11){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt122, $dtcct->ID_DTCCT); }
                    if($count==12){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc211, $dtcct->ID_DTCCT); }
                    if($count==13){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc212, $dtcct->ID_DTCCT); }
                    if($count==14){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt221, $dtcct->ID_DTCCT); }
                    if($count==15){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt222, $dtcct->ID_DTCCT); }
                    if($count==16){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt223, $dtcct->ID_DTCCT); }
                    if($count==17){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt224, $dtcct->ID_DTCCT); }
                    if($count==18){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt225, $dtcct->ID_DTCCT); }
                    if($count==19){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt226, $dtcct->ID_DTCCT); }
                    if($count==20){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt227, $dtcct->ID_DTCCT); }
                    if($count==21){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc311, $dtcct->ID_DTCCT); }
                    if($count==22){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc312, $dtcct->ID_DTCCT); }
                    if($count==23){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc313, $dtcct->ID_DTCCT); }
                    if($count==24){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc314, $dtcct->ID_DTCCT); }
                    if($count==25){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc315, $dtcct->ID_DTCCT); }
                    if($count==26){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc316, $dtcct->ID_DTCCT); }
                    if($count==27){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt321, $dtcct->ID_DTCCT); }
                    if($count==28){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lt322, $dtcct->ID_DTCCT); }
                    if($count==29){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc411, $dtcct->ID_DTCCT); }
                    if($count==30){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc412, $dtcct->ID_DTCCT); }
                    if($count==31){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc413, $dtcct->ID_DTCCT); }
                    if($count==32){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc414, $dtcct->ID_DTCCT); }
                    if($count==33){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc415, $dtcct->ID_DTCCT); }
                    if($count==34){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc416, $dtcct->ID_DTCCT); }
                    if($count==35){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc511, $dtcct->ID_DTCCT); }
                    if($count==36){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc512, $dtcct->ID_DTCCT); }
                    if($count==37){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc513, $dtcct->ID_DTCCT); }
                    if($count==38){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc514, $dtcct->ID_DTCCT); }
                    if($count==39){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc515, $dtcct->ID_DTCCT); }
                    if($count==40){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc516, $dtcct->ID_DTCCT); }
                    if($count==41){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc517, $dtcct->ID_DTCCT); }
                    if($count==42){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOP($lc518, $dtcct->ID_DTCCT); }
                }
                header('location:../../index.php?request=bcsMark&idsv=' . $getbangdiem->ID_SV);
                break;
            case 'updateByBCH':
                $idbd = $_GET['idbd'];
                $hocky = $_GET['hocky'];
                $namhoc = $_GET['namhoc'];

                $lc111 = $_POST['lop-111']; $lc112 = $_POST['lop-112']; $lc113 = $_POST['lop-113']; $lc114 = $_POST['lop-114']; $lc115 = $_POST['lop-115'];
                $lc116 = $_POST['lop-116']; $lc117 = $_POST['lop-117']; $lc118 = $_POST['lop-118']; $lc119 = $_POST['lop-119'];
                $lt121 = $_POST['lop-121']; $lt122 = $_POST['lop-122'];
                $suml1 = (int)$lc111 + (int)$lc112 + (int)$lc113 + (int)$lc114 + (int)$lc115 + (int)$lc116 + (int)$lc117 + (int)$lc118 + (int)$lc119 - (int)$lt121 - (int)$lt121;
                $kc111 = $_POST['khoa-111']; $kc112 = $_POST['khoa-112']; $kc113 = $_POST['khoa-113']; $kc114 = $_POST['khoa-114']; $kc115 = $_POST['khoa-115'];
                $kc116 = $_POST['khoa-116']; $kc117 = $_POST['khoa-117']; $kc118 = $_POST['khoa-118']; $kc119 = $_POST['khoa-119'];
                $kt121 = $_POST['khoa-121']; $kt122 = $_POST['khoa-122'];
                $sumk1 = (int)$kc111 + (int)$kc112 + (int)$kc113 + (int)$kc114 + (int)$kc115 + (int)$kc116 + (int)$kc117 + (int)$kc118 + (int)$kc119 - (int)$kt121 - (int)$kt121;

                $lc211 = $_POST['lop-211']; $lc212 = $_POST['lop-212'];
                $lt221 = $_POST['lop-221']; $lt222 = $_POST['lop-222']; $lt223 = $_POST['lop-223']; $lt224 = $_POST['lop-224']; $lt225 = $_POST['lop-225'];
                $lt226 = $_POST['lop-226']; $lt227 = $_POST['lop-227'];
                $suml2 = (int)$lc211 + (int)$lc212 - (int)$lt221 - (int)$lt222 - (int)$lt223 - (int)$lt224 - (int)$lt225 - (int)$lt226 - (int)$lt227;
                $kc211 = $_POST['khoa-211']; $kc212 = $_POST['khoa-212'];
                $kt221 = $_POST['khoa-221']; $kt222 = $_POST['khoa-222']; $kt223 = $_POST['khoa-223']; $kt224 = $_POST['khoa-224']; $kt225 = $_POST['khoa-225'];
                $kt226 = $_POST['khoa-226']; $kt227 = $_POST['khoa-227'];
                $sumk2 = (int)$kc211 + (int)$kc212 - (int)$kt221 - (int)$kt222 - (int)$kt223 - (int)$kt224 - (int)$kt225 - (int)$kt226 - (int)$kt227;
                
                $lc311 = $_POST['lop-311']; $lc312 = $_POST['lop-312']; $lc313 = $_POST['lop-313']; $lc314 = $_POST['lop-314']; $lc315 = $_POST['lop-315'];
                $lc316 = $_POST['lop-316'];
                $lt321 = $_POST['lop-321']; $lt322 = $_POST['lop-322'];
                $suml3 = (int)$lc311 + (int)$lc312 + (int)$lc313 + (int)$lc314 + (int)$lc315 + (int)$lc316 - (int)$lt321 - (int)$lt322;  
                $kc311 = $_POST['khoa-311']; $kc312 = $_POST['khoa-312']; $kc313 = $_POST['khoa-313']; $kc314 = $_POST['khoa-314']; $kc315 = $_POST['khoa-315'];
                $kc316 = $_POST['khoa-316'];
                $kt321 = $_POST['khoa-321']; $kt322 = $_POST['khoa-322'];
                $sumk3 = (int)$kc311 + (int)$kc312 + (int)$kc313 + (int)$kc314 + (int)$kc315 + (int)$kc316 - (int)$kt321 - (int)$kt322;  

                $lc411 = $_POST['lop-411']; $lc412 = $_POST['lop-412']; $lc413 = $_POST['lop-413']; $lc414 = $_POST['lop-414']; $lc415 = $_POST['lop-415'];
                $lc416 = $_POST['lop-416'];
                $suml4 = (int)$lc411 + (int)$lc412 + (int)$lc413 + (int)$lc414 + (int)$lc415 + (int)$lc416;
                $kc411 = $_POST['khoa-411']; $kc412 = $_POST['khoa-412']; $kc413 = $_POST['khoa-413']; $kc414 = $_POST['khoa-414']; $kc415 = $_POST['khoa-415'];
                $kc416 = $_POST['khoa-416'];
                $sumk4 = (int)$kc411 + (int)$kc412 + (int)$kc413 + (int)$kc414 + (int)$kc415 + (int)$kc416;

                $lc511 = $_POST['lop-511']; $lc512 = $_POST['lop-512']; $lc513 = $_POST['lop-513']; $lc514 = $_POST['lop-514']; $lc515 = $_POST['lop-515'];
                $lc516 = $_POST['lop-516']; $lc517 = $_POST['lop-517']; $lc518 = $_POST['lop-518'];
                $suml5 = (int)$lc511 + (int)$lc512 + (int)$lc513 + (int)$lc514 + (int)$lc515 + (int)$lc516 + (int)$lc517 + (int)$lc518;
                $kc511 = $_POST['khoa-511']; $kc512 = $_POST['khoa-512']; $kc513 = $_POST['khoa-513']; $kc514 = $_POST['khoa-514']; $kc515 = $_POST['khoa-515'];
                $kc516 = $_POST['khoa-516']; $kc517 = $_POST['khoa-517']; $kc518 = $_POST['khoa-518'];
                $sumk5 = (int)$kc511 + (int)$kc512 + (int)$kc513 + (int)$kc514 + (int)$kc515 + (int)$kc516 + (int)$kc517 + (int)$kc518;

                if($suml1 > 20){
                    $suml1 = 20;
                }
                if($sumk1 > 20){
                    $sumk1 = 20;
                }
                if($suml2 > 25){
                    $suml2 = 25;
                }
                if($sumk2 > 25){
                    $sumk2 = 25;
                }
                if($suml3 > 20){
                    $suml3 = 20;
                }
                if($sumk3 > 20){
                    $sumk3 = 20;
                }
                if($suml4 > 25){
                    $suml4 = 25;
                }
                if($sumk4 > 25){
                    $sumk4 = 25;
                }
                if($suml5 > 10){
                    $suml5 = 10;
                }
                if($sumk5 > 10){
                    $sumk5 = 10;
                }

                $suml = $suml1 + $suml2 + $suml3 + $suml4 + $suml5;
                $sumk = $sumk1 + $sumk2 + $sumk3 + $sumk4 + $sumk5;
                
                $bangdiem = new Bangdiem();
                $getbangdiem = $bangdiem->BangdiemGetbyId($idbd);
                $resultBD = $bangdiem->BangdiemUpdateTONGDIEMLOPANDKHOA($suml, $sumk, $idbd);

                $diemtc = new DiemTC();
                $getallDTC = $diemtc->DiemTCGetbyIdBD($idbd);
                foreach($getallDTC as $dtc){
                    if($dtc->ID_TC == 1){ $result = $diemtc->DiemTCUpdateTONGDIEMLOPANDKHOA($suml1, $sumk1, $dtc->ID_DTC); }
                    if($dtc->ID_TC == 2){ $result = $diemtc->DiemTCUpdateTONGDIEMLOPANDKHOA($suml2, $sumk2, $dtc->ID_DTC); }
                    if($dtc->ID_TC == 3){ $result = $diemtc->DiemTCUpdateTONGDIEMLOPANDKHOA($suml3, $sumk3, $dtc->ID_DTC); }
                    if($dtc->ID_TC == 4){ $result = $diemtc->DiemTCUpdateTONGDIEMLOPANDKHOA($suml4, $sumk4, $dtc->ID_DTC); }
                    if($dtc->ID_TC == 5){ $result = $diemtc->DiemTCUpdateTONGDIEMLOPANDKHOA($suml5, $sumk5, $dtc->ID_DTC); }
                }

                $diemtcct = new DiemTCCT();
                $getAllDTCCT = $diemtcct->DiemTCCTGetbyIdBD($idbd);
                $count = 0;
                foreach($getAllDTCCT as $dtcct){
                    $count++;
                    if($count==1){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc111, $kc111, $dtcct->ID_DTCCT); }
                    if($count==2){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc112, $kc112, $dtcct->ID_DTCCT); }
                    if($count==3){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc113, $kc113, $dtcct->ID_DTCCT); }
                    if($count==4){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc114, $kc114, $dtcct->ID_DTCCT); }
                    if($count==5){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc115, $kc115, $dtcct->ID_DTCCT); }
                    if($count==6){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc116, $kc116, $dtcct->ID_DTCCT); }
                    if($count==7){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc117, $kc117, $dtcct->ID_DTCCT); }
                    if($count==8){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc118, $kc118, $dtcct->ID_DTCCT); }
                    if($count==9){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc119, $kc119, $dtcct->ID_DTCCT); }
                    if($count==10){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt121, $kt121, $dtcct->ID_DTCCT); }
                    if($count==11){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt122, $kt122, $dtcct->ID_DTCCT); }
                    if($count==12){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc211, $kc211, $dtcct->ID_DTCCT); }
                    if($count==13){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc212, $kc212, $dtcct->ID_DTCCT); }
                    if($count==14){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt221, $kt221, $dtcct->ID_DTCCT); }
                    if($count==15){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt222, $kt222, $dtcct->ID_DTCCT); }
                    if($count==16){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt223, $kt223, $dtcct->ID_DTCCT); }
                    if($count==17){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt224, $kt224, $dtcct->ID_DTCCT); }
                    if($count==18){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt225, $kt225, $dtcct->ID_DTCCT); }
                    if($count==19){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt226, $kt226, $dtcct->ID_DTCCT); }
                    if($count==20){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt227, $kt227, $dtcct->ID_DTCCT); }
                    if($count==21){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc311, $kc311, $dtcct->ID_DTCCT); }
                    if($count==22){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc312, $kc312, $dtcct->ID_DTCCT); }
                    if($count==23){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc313, $kc313, $dtcct->ID_DTCCT); }
                    if($count==24){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc314, $kc314, $dtcct->ID_DTCCT); }
                    if($count==25){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc315, $kc315, $dtcct->ID_DTCCT); }
                    if($count==26){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc316, $kc316, $dtcct->ID_DTCCT); }
                    if($count==27){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt321, $kt321, $dtcct->ID_DTCCT); }
                    if($count==28){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lt322, $kt322, $dtcct->ID_DTCCT); }
                    if($count==29){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc411, $kc411, $dtcct->ID_DTCCT); }
                    if($count==30){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc412, $kc412, $dtcct->ID_DTCCT); }
                    if($count==31){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc413, $kc413, $dtcct->ID_DTCCT); }
                    if($count==32){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc414, $kc414, $dtcct->ID_DTCCT); }
                    if($count==33){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc415, $kc415, $dtcct->ID_DTCCT); }
                    if($count==34){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc416, $kc416, $dtcct->ID_DTCCT); }
                    if($count==35){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc511, $kc511, $dtcct->ID_DTCCT); }
                    if($count==36){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc512, $kc512, $dtcct->ID_DTCCT); }
                    if($count==37){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc513, $kc513, $dtcct->ID_DTCCT); }
                    if($count==38){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc514, $kc514, $dtcct->ID_DTCCT); }
                    if($count==39){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc515, $kc515, $dtcct->ID_DTCCT); }
                    if($count==40){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc516, $kc516, $dtcct->ID_DTCCT); }
                    if($count==41){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc517, $kc517, $dtcct->ID_DTCCT); }
                    if($count==42){ $result = $diemtcct->DiemTCCTUpdateTONGDIEMLOPANDKHOA($lc518, $kc518, $dtcct->ID_DTCCT); }
                }
                header('location:../../index.php?request=bchMark&idsv=' . $getbangdiem->ID_SV . '&hocky=' . $hocky . '&namhoc=' . $namhoc);

                break;
            case 'delete':
                $idbd = $_GET['idbd'];
                $bangdiem = new Bangdiem();
                $minhchung = new Minhchung();
                $diemtc = new DiemTC();
                $diemtcct = new DiemTCCT();

                $getbangdiem = $bangdiem->BangdiemGetbyId($idbd);

                $getAllDTC = $diemtc->DiemTCGetbyIdBD($idbd);
                $getAllDTCCT = $diemtcct->DiemTCCTGetbyIdBD($idbd);
                foreach($getAllDTCCT as $dtcct){
                    $getAllMC = $minhchung->MinhchungGetbyIDDTCCT($dtcct->ID_DTCCT);
                    foreach($getAllMC as $mc){
                        $resultMC = $minhchung->MinhchungDelete($mc->ID_MC);
                    }
                    $resultDTCCT = $diemtcct->DiemTCCTDelete($dtcct->ID_DTCCT);
                }
                foreach($getAllDTC as $dtc){
                    $resultDTC = $diemtc->DiemTCDelete($dtc->ID_DTC);
                }
                $resultBD = $bangdiem->BangdiemDelete($idbd);

                header('location:../../index.php?request=scoreOfSV&idsv=' . $getbangdiem->ID_SV . '&hocky=' . $getbangdiem->HOCKY . '&namhoc=' . $getbangdiem->NAMHOC);
                
                break;
        }
    }
?>