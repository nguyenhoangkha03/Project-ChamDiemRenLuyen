<?php 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require '../../database/vbhdCls.php';
    require '../../database/fileCls.php';
    require '../../database/hinhanhCls.php';
    require '../../database/luotxemCls.php';
    require '../../database/likesCls.php';
    if(isset($_GET['reqact'])){
        $requestAction = $_GET['reqact'];
        switch($requestAction){
            case 'addNew':
                $datetime = date('Y-m-d H:i:s');
                $idsv = $_GET['idsv'];
                $noidung = $_POST['noidung'];

                $vbhd = new VBHD();
                $result = $vbhd->VBHDAdd(null, $noidung, $datetime, 0, $idsv);
                $getvbhdLast = $vbhd->VBHDGetLast();

                if (isset($_FILES['fileanh']['name'])) {
                    foreach ($_FILES['fileanh']['tmp_name'] as $key => $tmp_name) {
                        if (!empty($tmp_name)) {;
                            $hinhanh = file_get_contents($tmp_name);
                            $hinhanh = base64_encode($hinhanh);
                            
                            $image = new Hinhanh();
                            $resultHA = $image->HinhanhAdd($hinhanh, $getvbhdLast->ID_VBHD);
                        } else {
                            echo "Không có tệp nào được tải lên.<br>";
                        }
                    }
                } else {
                    echo 'Tải tệp lên.';
                }  

                if (isset($_FILES['files'])) {
                    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
                        if (!empty($tmp_name)) {
                            $fileContent = file_get_contents($tmp_name);
                            $encodedContent = base64_encode($fileContent);
                
                            $fileType = '';
                            $fileExtension = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);
                
                            switch ($fileExtension) {
                                case 'pdf':
                                    $fileType = 'PDF';
                                    break;
                                case 'doc':
                                    $fileType = 'DOC';
                                    break;
                                case 'docx':
                                    $fileType = 'DOCX';
                                    break;
                                default:
                                    $fileType = 'Unknown';
                            }
                            $file = new File();
                            $resultFILE = $file->FileAdd($_FILES['files']['name'][$key], $encodedContent, $getvbhdLast->ID_VBHD);
                        } else {
                            echo "Không có tệp nào được tải lên.<br>";
                        }
                    }
                } else {
                    echo 'Tải tệp lên.';
                }

                header('location:../../index.php?request=vbhdView');

                break;
            case 'view':
                $idsv = $_POST['idsv'];
                $idvbhd = $_POST['idvbhd'];
                $luotxem = new Luotxem();
                
                $getcheck = $luotxem->LuotxemGetAllByIDSVANDIDVBHD($idsv, $idvbhd);
                if($getcheck == null){
                    $result = $luotxem->LuotxemAdd($idsv, $idvbhd);
                }

                break;
            case 'delete':
                $idvbhd = $_GET['id'];
                $vbhd = new VBHD();
                $file = new File();
                $hinhanh = new Hinhanh();
                $luotxem = new Luotxem();
                $like = new LIKES();

                $getAllFile = $file->FileGetbyIdVBHD($idvbhd);
                $getAllHinhanh = $hinhanh->HinhanhGetbyIdVBHD($idvbhd);
                $getAllLuotxem = $luotxem->LuotxemGetAllByIDVBHD($idvbhd);
                $getAllLikes = $like->LikesGetAllByIDVBHD($idvbhd);

                // Xoa File
                foreach($getAllFile as $f){ $resFile = $file->FileDelete($f->ID_FILE); }
                // Xoa Hinhanh
                foreach($getAllHinhanh as $hh) { $resHA = $hinhanh->HinhanhDelete($hh->ID_HA); }
                // Xoa luot xem
                foreach($getAllLuotxem as $lx) { $resLX = $luotxem->LuotxemDelete($lx->ID_LX); }
                // Xoa Like
                foreach($getAllLikes as $l) { $resLike = $like->LikesDelete($l->ID_LIKE); }

                $result = $vbhd->VBHDDelete($idvbhd);
                if($result){
                    header('location:../../index.php?request=vbhdView&result=ok');
                }
                else{
                    header('location:../../index.php?request=vbhdView&result=notok');
                }

                break;
            case 'update':
                $idlop = $_GET['idlop'];
                $lop = new Lop();

                $tenlop = $_POST['tenlop'];
                $khoahoc = $_POST['khoahoc'];
                $soluongsinhvien = $_POST['soluongsinhvien'];

                $result = $lop->LopUpdate($tenlop, $khoahoc, $soluongsinhvien, $idlop);

                if($result){
                    header('location:../../index.php?request=lopView&idlop=' .$idlop.'&result=ok');

                }
                else{
                    header('location:../../index.php?request=lopView&idlop=' .$idlop.'&result=notok');
                }

                break;
        }
    }
?>