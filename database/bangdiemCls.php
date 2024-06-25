<?php 
    $a = './database/database.php';
    $b = '../database/database.php';
    $c = '../../database/database.php';
    if(file_exists($a)){
        $file = $a;
    }
    else if(file_exists($b)){
        $file = $b;
    }
    else{
        $file = $c;
    }
    require_once $file;
    class Bangdiem extends Database{
        public function BangdiemGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM bangdiem");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function BangdiemAdd($hocky, $namhoc, $tongdiemsv, $diemdiemlop, $tongdiemkhoa, $idsv){
            $add = $this->connect->prepare("INSERT INTO bangdiem(HOCKY, NAMHOC, TONGDIEMSV, TONGDIEMLOP, TONGDIEMKHOA, ID_SV) VALUES (?,?,?,?,?,?)");
            $add->execute(array($hocky, $namhoc, $tongdiemsv, $diemdiemlop, $tongdiemkhoa, $idsv));
            
            return $add->rowCount();
        }
        public function BangdiemDelete($idbd) {
            $del = $this->connect->prepare("DELETE FROM bangdiem WHERE ID_BD = ?");
            $del->execute(array($idbd));

            return $del->rowCount();
        }
        public function BangdiemUpdate($hocky, $namhoc, $tongdiemsv, $diemdiemlop, $tongdiemkhoa, $idsv, $idbd) {
            $update = $this->connect->prepare("UPDATE bangdiem SET HOCKY = ?, NAMHOC = ?, TONGDIEMSV = ?, TONGDIEMLOP = ?, TONGDIEMKHOA = ?, ID_SV = ?"
                                                . " WHERE ID_BD = ?");
            $update->execute(array($hocky, $namhoc, $tongdiemsv, $diemdiemlop, $tongdiemkhoa, $idsv, $idbd));
            
            return $update->rowCount();
        }
        public function BangdiemGetbyId($idbd) {
            $getBD = $this->connect->prepare("SELECT * FROM bangdiem WHERE ID_BD = ?");
            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute(array($idbd));
            
            return $getBD->fetch();
        }
    }
?>