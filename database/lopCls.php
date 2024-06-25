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
    class Lop extends Database{
        public function LopGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM lop");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function LopAdd($tenlop, $khoahoc, $soluongsv){
            $add = $this->connect->prepare("INSERT INTO lop(TENLOP, KHOAHOC, SOLUONGSV) VALUES (?,?,?)");
            $add->execute(array($tenlop, $khoahoc, $soluongsv));
            
            return $add->rowCount();
        }
        public function LopDelete($idlop) {
            $del = $this->connect->prepare("DELETE FROM lop WHERE ID_LOP = ?");
            $del->execute(array($idlop));

            return $del->rowCount();
        }
        public function LopUpdate($tenlop, $khoahoc, $soluongsv, $idlop) {
            $update = $this->connect->prepare("UPDATE lop SET TENLOP = ?, KHOAHOC = ?, SOLUONGSV = ?"
                                                . " WHERE ID_LOP = ?");
            $update->execute(array($tenlop, $khoahoc, $soluongsv, $idlop));
            
            return $update->rowCount();
        }
        public function LopGetbyId($idlop) {
            $getLop = $this->connect->prepare("SELECT * FROM lop WHERE ID_LOP = ?");
            $getLop->setFetchMode(PDO::FETCH_OBJ);
            $getLop->execute(array($idlop));
            
            return $getLop->fetch();
        }
        public function LopSearchName($text){
            $getLop = $this->connect->prepare("select * from lop where TENLOP LIKE '%$text%'");
            $getLop->setFetchMode(PDO::FETCH_OBJ);
            $getLop->execute();

            return $getLop->fetchAll();
        }
    }
?>