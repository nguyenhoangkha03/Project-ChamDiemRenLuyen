<?php 
    if(isset($_GET["request"])){
        $request = $_GET['request'];
        switch($request){
            case 'lopView':
                require './process/lop/lopView.php';
                break;
            case 'lopAdd':
                require './process/lop/lopAdd.php';
                break;
            case 'lopUpdate':
                require './process/lop/lopUpdate.php';
                break;
            case 'sinhvienView':
                require './process/sinhvien/sinhvienView.php';
                break;
            case 'sinhvienAdd':
                require './process/sinhvien/sinhvienAdd.php';
                break;
            case 'sinhvienUpdate':
                require './process/sinhvien/sinhvienUpdate.php';
                break;
            case 'scoreView':
                require './process/bangdiem/bangdiemView.php';
                break;
            case 'bchView':
                require './process/bch/bchView.php';
                break;
            case 'bchAdd':
                require './process/bch/bchView.php';
                break;
            case 'bchAddNew':
                require './process/bch/bchAddNew.php';
                break;
            case 'bchUpdate':
                require './process/bch/bchUpdate.php';
                break;
            case 'vbhdView':
                require './process/vbhd/vbhdView.php';
                break;
            case 'profile':
                require './profile.php';
                break;
            case 'taikhoanView':
                require './process/taikhoan/taikhoanView.php';
                break; 
            case 'taikhoanAdd':
                require './process/taikhoan/taikhoanAdd.php';
                break; 
            case 'taikhoanUpdate':
                require './process/taikhoan/taikhoanUpdate.php';
                break;  
            case 'bcs-sinhvien':
                require './process/bangdiem/bcs_sinhvien.php';
                break;
            case 'bcsMark':
                require './process/bangdiem/bcs_cham.php';
                break;
            case 'managerScoreLop':
                require './process/diemmanager/lopmanager.php';
                break;
            case 'managerScoreSV':
                require './process/diemmanager/svmanager.php';
                break;
            case 'bchMark':
                require './process/diemmanager/bch_cham.php';
                break;
            case 'scoreOfSV':
                require './process/diemmanager/diemofsv.php';
                break;
            case 'scoreWatch':
                require './process/bangdiem/bangdiemWatch.php';
                break;
        }
    }
    else{

    }
?>