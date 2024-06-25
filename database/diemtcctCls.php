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
    class DiemTCCT extends Database{
        public function DiemTCCTGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM diemtcct");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function DiemTCCTAdd($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtcct){
            $add = $this->connect->prepare("INSERT INTO diemtcct(TONGDIEMSV, TONGDIEMLOP, TONGDIEMKHOA, ID_BD, ID_TCCT) VALUES (?,?,?,?,?)");
            $add->execute(array($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtcct));
            
            return $add->rowCount();
        }
        public function DiemTCCTDelete($iddtcct) {
            $del = $this->connect->prepare("DELETE FROM diemtcct WHERE ID_DTCCT = ?");
            $del->execute(array($iddtcct));

            return $del->rowCount();
        }
        public function DiemTCCTUpdate($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtcct, $iddtcct) {
            $update = $this->connect->prepare("UPDATE diemtcct SET TONGDIEMSV = ?, TONGDIEMLOP = ?, TONGDIEMKHOA = ?, ID_BD = ?, ID_TCCT = ?"
                                                . " WHERE ID_DTCCT = ?");
            $update->execute(array($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtcct, $iddtcct));
            
            return $update->rowCount();
        }
        public function DiemTCCTGetbyId($iddtcct) {
            $getDTCCT = $this->connect->prepare("SELECT * FROM diemtcct WHERE ID_DTCCT = ?");
            $getDTCCT->setFetchMode(PDO::FETCH_OBJ);
            $getDTCCT->execute(array($iddtcct));
            
            return $getDTCCT->fetch();
        }
    }
?>