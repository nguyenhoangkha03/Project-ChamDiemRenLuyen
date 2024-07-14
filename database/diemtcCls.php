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
    class DiemTC extends Database{
        public function DiemTCGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM diemtc");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function DiemTCAdd($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtc){
            $add = $this->connect->prepare("INSERT INTO diemtc(TONGDIEMSV, TONGDIEMLOP, TONGDIEMKHOA, ID_BD, ID_TC) VALUES (?,?,?,?,?)");
            $add->execute(array($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtc));
            
            return $add->rowCount();
        }
        public function DiemTCDelete($iddtc) {
            $del = $this->connect->prepare("DELETE FROM diemtc WHERE ID_DTC = ?");
            $del->execute(array($iddtc));

            return $del->rowCount();
        }
        public function DiemTCUpdate($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtc, $iddtc) {
            $update = $this->connect->prepare("UPDATE diemtc SET TONGDIEMSV = ?, TONGDIEMLOP = ?, TONGDIEMKHOA = ?, ID_BD = ?, ID_TC = ?"
                                                . " WHERE ID_DTC = ?");
            $update->execute(array($tongdiemsv, $tongdiemlop, $tongdiemkhoa, $idbd, $idtc, $iddtc));
            
            return $update->rowCount();
        }
        public function DiemTCUpdateTONGDIEMLOP($tongdiemlop, $iddtc) {
            $update = $this->connect->prepare("UPDATE diemtc SET TONGDIEMLOP = ?"
                                                . " WHERE ID_DTC = ?");
            $update->execute(array($tongdiemlop, $iddtc));
            
            return $update->rowCount();
        }
        public function DiemTCGetbyId($iddtc) {
            $getDTC = $this->connect->prepare("SELECT * FROM diemtc WHERE ID_DTC = ?");
            $getDTC->setFetchMode(PDO::FETCH_OBJ);
            $getDTC->execute(array($iddtc));
            
            return $getDTC->fetch();
        }

        public function DiemTCGetbyIdBD($idbd) {
            $getDTC = $this->connect->prepare("SELECT * FROM diemtc WHERE ID_BD = ?");
            $getDTC->setFetchMode(PDO::FETCH_OBJ);
            $getDTC->execute(array($idbd));
            
            return $getDTC->fetchAll();
        }
    }
?>