<?php 
    require '../../database/sinhvienCls.php';
    require '../../database/mangxahoiCls.php';
    require '../../database/taikhoanCls.php';
    require '../../database/luotxemCls.php';
    require '../../database/vbhdCls.php';
    require '../../database/likesCls.php';
    require '../../database/bangdiemCls.php';
    require '../../database/fileCls.php';
    require '../../database/hinhanhCls.php';
    require '../../database/minhchungCls.php';
    require '../../database/diemtcCls.php';
    require '../../database/diemtcctCls.php';
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
                $mangxahoi = new MXH();
                $taikhoan = new Taikhoan();
                $luotxem = new Luotxem();
                $vbhd = new VBHD();
                $like = new LIKES();
                $bangdiem = new Bangdiem();
                $file = new File();
                $hinhanh = new Hinhanh();
                $minhchung = new Minhchung();
                $diemtc = new DiemTC();
                $diemtcct = new DiemTCCT();

                $getMXH = $mangxahoi->MXHGetByIDSV($idsv);
                $getAllTK = $taikhoan->TaiKhoanGetByIdSV($idsv);
                $getAllLXSV = $luotxem->LuotxemGetAllByIDSV($idsv);
                $getAllVBHD = $vbhd->VBHDGetbyIdSV($idsv);
                $getAllLikeSV = $like->LikesGetAllByIDSV($idsv);
                $getAllBD = $bangdiem->BangdiemGetbyIdSV($idsv);

                if($getMXH != null){
                    $resMXH = $mangxahoi->MXHDelete($getMXH->ID_MXH);
                }
                foreach($getAllTK as $tk){
                    $resTK = $taikhoan->TaiKhoanDelete($tk->ID_TK);
                }
                foreach($getAllLXSV as $lx){
                    $resLX = $luotxem->LuotxemUpdate($lx->ID_LX);
                }
                foreach($getAllLikeSV as $l){
                    $resLIKE = $like->LikeUpdate($l->ID_LIKE);
                }
                foreach($getAllVBHD as $vb){
                    $getAllFile = $file->FileGetbyIdVBHD($vb->ID_VBHD);
                    $getAllHA = $hinhanh->HinhanhGetbyIdVBHD($vb->ID_VBHD);
                    foreach($getAllFile as $f){
                        $resFILE = $file->FileDelete($f->ID_FILE);
                    }
                    foreach($getAllHA as $ha){
                        $resHA = $hinhanh->HinhanhDelete($ha->ID_HA);
                    }

                    $getAllLXVBHD = $luotxem->LuotxemGetAllByIDVBHD($vb->ID_VBHD);
                    $getAllLikeVBHD = $like->LikesGetAllByIDVBHD($vb->ID_VBHD);

                    foreach($getAllLXVBHD as $t){
                        $res = $luotxem->LuotxemDelete($t->ID_LX);
                    }
                    foreach($getAllLikeVBHD as $t){
                        $res = $like->LikesDelete($t->ID_LIKE);
                    }

                    $resVBHD = $vbhd->VBHDDelete($vb->ID_VBHD);
                }
                foreach($getAllBD as $bd){
                    $getAllDTC = $diemtc->DiemTCGetbyIdBD($bd->ID_BD);
                    $getAllDTCCT = $diemtcct->DiemTCCTGetbyIdBD($bd->ID_BD);
                    foreach($getAllDTCCT as $dtcct){
                        $getAllMC = $minhchung->MinhchungGetbyIDDTCCT($dtcct->ID_DTCCT);
                        foreach($getAllMC as $mc){
                            $res = $minhchung->MinhchungDelete($mc->ID_MC);
                        }
                        $res = $diemtcct->DiemTCCTDelete($dtcct->ID_DTCCT);
                    }
                    foreach($getAllDTC as $dtc){
                        $res = $diemtc->DiemTCDelete($dtc->ID_DTC);
                    }

                    $resBD = $bangdiem->BangdiemDelete($bd->ID_BD);
                }


                $getsv = $sinhvien->SinhVienGetById($idsv);
                $idlop = $getsv->ID_LOP;

                $result = $sinhvien->SinhVienDelete($idsv);
                if($result){
                    header('location:../../index.php?request=sinhvienView&idlop=' . $idlop . '&result=ok');
                }
                else{
                    header('location:../../index.php?request=sinhvienView&idlop=' . $idlop . '&result=notok');
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

                $facebook = $_POST['facebook'];
                $instagram = $_POST['instagram'];
                


                $sinhvien = new Sinhvien();
                $result = $sinhvien->SinhVienAdd($mssv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, true, $chucvu, $idlop);

                $mxh = new MXH();
                $svLast = $sinhvien->SinhvienIdLonNhat();
                $resultMXH = $mxh->MXHAdd($facebook, $instagram, $svLast->ID_SV);

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

                $facebook = $_POST['facebook'];
                $instagram = $_POST['instagram'];

                $mxh = new MXH();
                $getmxh = $mxh->MXHGetByIDSV($idsv);
                $resultMXH = $mxh->MXHUpdate($facebook, $instagram, $idsv, $getmxh->ID_MXH);


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
                $mangxahoi = new MXH();
                $taikhoan = new Taikhoan();
                $luotxem = new Luotxem();
                $vbhd = new VBHD();
                $like = new LIKES();
                $bangdiem = new Bangdiem();
                $file = new File();
                $hinhanh = new Hinhanh();
                $minhchung = new Minhchung();
                $diemtc = new DiemTC();
                $diemtcct = new DiemTCCT();

                $getMXH = $mangxahoi->MXHGetByIDSV($idsv);
                $getAllTK = $taikhoan->TaiKhoanGetByIdSV($idsv);
                $getAllLXSV = $luotxem->LuotxemGetAllByIDSV($idsv);
                $getAllVBHD = $vbhd->VBHDGetbyIdSV($idsv);
                $getAllLikeSV = $like->LikesGetAllByIDSV($idsv);
                $getAllBD = $bangdiem->BangdiemGetbyIdSV($idsv);

                if($getMXH != null){
                    $resMXH = $mangxahoi->MXHDelete($getMXH->ID_MXH);
                }
                foreach($getAllTK as $tk){
                    $resTK = $taikhoan->TaiKhoanDelete($tk->ID_TK);
                }
                foreach($getAllLXSV as $lx){
                    $resLX = $luotxem->LuotxemUpdate($lx->ID_LX);
                }
                foreach($getAllLikeSV as $l){
                    $resLIKE = $like->LikeUpdate($l->ID_LIKE);
                }
                foreach($getAllVBHD as $vb){
                    $getAllFile = $file->FileGetbyIdVBHD($vb->ID_VBHD);
                    $getAllHA = $hinhanh->HinhanhGetbyIdVBHD($vb->ID_VBHD);
                    foreach($getAllFile as $f){
                        $resFILE = $file->FileDelete($f->ID_FILE);
                    }
                    foreach($getAllHA as $ha){
                        $resHA = $hinhanh->HinhanhDelete($ha->ID_HA);
                    }

                    $getAllLXVBHD = $luotxem->LuotxemGetAllByIDVBHD($vb->ID_VBHD);
                    $getAllLikeVBHD = $like->LikesGetAllByIDVBHD($vb->ID_VBHD);

                    foreach($getAllLXVBHD as $t){
                        $res = $luotxem->LuotxemDelete($t->ID_LX);
                    }
                    foreach($getAllLikeVBHD as $t){
                        $res = $like->LikesDelete($t->ID_LIKE);
                    }

                    $resVBHD = $vbhd->VBHDDelete($vb->ID_VBHD);
                }
                foreach($getAllBD as $bd){
                    $getAllDTC = $diemtc->DiemTCGetbyIdBD($bd->ID_BD);
                    $getAllDTCCT = $diemtcct->DiemTCCTGetbyIdBD($bd->ID_BD);
                    foreach($getAllDTCCT as $dtcct){
                        $getAllMC = $minhchung->MinhchungGetbyIDDTCCT($dtcct->ID_DTCCT);
                        foreach($getAllMC as $mc){
                            $res = $minhchung->MinhchungDelete($mc->ID_MC);
                        }
                        $res = $diemtcct->DiemTCCTDelete($dtcct->ID_DTCCT);
                    }
                    foreach($getAllDTC as $dtc){
                        $res = $diemtc->DiemTCDelete($dtc->ID_DTC);
                    }

                    $resBD = $bangdiem->BangdiemDelete($bd->ID_BD);
                }


                $getsv = $sinhvien->SinhVienGetById($idsv);
                $idlop = $getsv->ID_LOP;

                $result = $sinhvien->SinhVienDelete($idsv);
                if($result){
                    header('location:../../index.php?request=bchView');
                }
                else{
                    header('location:../../index.php?request=bchView');
                }

                break;
        }
    }
?>