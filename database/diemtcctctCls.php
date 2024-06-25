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
    class DiemTCCTCT extends Database{
        public function DiemTCCTCTGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM diemtcctct");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function DiemTCCTCTAdd($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtcctct){
            $add = $this->connect->prepare("INSERT INTO diemtcctct(TONGDIEMSV, TONGDIEMLOP, TONGDIEMKHOA, ID_BD, ID_TCCTCT) VALUES (?,?,?,?,?)");
            $add->execute(array($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtcctct));
            
            return $add->rowCount();
        }
        public function DiemTCCTCTDelete($iddtcctct) {
            $del = $this->connect->prepare("DELETE FROM diemtcctct WHERE ID_DTCCTCT = ?");
            $del->execute(array($iddtcctct));

            return $del->rowCount();
        }
        public function DiemTCCTCTUpdate($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtcctct, $iddtcctct) {
            $update = $this->connect->prepare("UPDATE diemtcctct SET TONGDIEMSV = ?, TONGDIEMLOP = ?, TONGDIEMKHOA = ?, ID_BD = ?, ID_TCCTCT = ?"
                                                . " WHERE ID_DTCCTCT = ?");
            $update->execute(array($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtcctct, $iddtcctct));
            
            return $update->rowCount();
        }
        public function DiemTCCTCTGetbyId($iddtcctct) {
            $getDTCCTCT = $this->connect->prepare("SELECT * FROM diemtcctct WHERE ID_DTCCTCT = ?");
            $getDTCCTCT->setFetchMode(PDO::FETCH_OBJ);
            $getDTCCTCT->execute(array($iddtcctct));
            
            return $getDTCCTCT->fetch();
        }
    }
?>