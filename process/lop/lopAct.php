<?php 
    require '../../database/lopCls.php';
    if(isset($_GET['reqact'])){
        $requestAction = $_GET['reqact'];
        switch($requestAction){
            case 'addNew':
                $tenlop = $_POST['tenlop'];
                $khoahoc = $_POST['khoahoc'];
                $soluongsinhvien = $_POST['soluongsinhvien'];

                echo $khoahoc;

                $lop = new Lop();
                $result = $lop->LopAdd($tenlop, $khoahoc, $soluongsinhvien);

                if($result){
                    header('location:../../index.php?request=lopView&result=ok');
                }
                else{
                    header('location:../../index.php?request=lopView&result=notok');
                }
                break;
            case 'delete':
                $idlop = $_GET['id'];
                $lop = new Lop();

                $result = $lop->LopDelete($idlop);
                if($result){
                    header('location:../../index.php?request=lopView&result=ok');
                }
                else{
                    header('location:../../index.php?request=lopView&result=notok');
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