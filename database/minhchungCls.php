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
    class Minhchung extends Database{
        public function MinhchungGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM minhchung");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function MinhchungAdd($file, $iddtcct){
            $add = $this->connect->prepare("INSERT INTO minhchung(FILE, ID_DTCCT) VALUES (?,?)");
            $add->execute(array($file, $iddtcct));
            
            return $add->rowCount();
        }
        public function MinhchungDelete($idmc) {
            $del = $this->connect->prepare("DELETE FROM minhchung WHERE ID_MC = ?");
            $del->execute(array($idmc));

            return $del->rowCount();
        }
        public function HinhanhUpdate($filehinh, $idvbhd, $idha) {
            $update = $this->connect->prepare("UPDATE hinhanh SET FILEHINH = ?, ID_VBHD = ?"
                                                . " WHERE ID_HA = ?");
            $update->execute(array($filehinh, $idvbhd, $idha));
            
            return $update->rowCount();
        }
        public function HinhanhGetbyId($idha) {
            $getHinhanh = $this->connect->prepare("SELECT * FROM hinhanh WHERE ID_HA = ?");
            $getHinhanh->setFetchMode(PDO::FETCH_OBJ);
            $getHinhanh->execute(array($idha));
            
            return $getHinhanh->fetch();
        }

        public function MinhchungGetbyIDDTCCT($iddtcct) {
            $getMC = $this->connect->prepare("SELECT * FROM minhchung WHERE ID_DTCCT = ?");
            $getMC->setFetchMode(PDO::FETCH_OBJ);
            $getMC->execute(array($iddtcct));
            
            return $getMC->fetchAll();
        }
    }
?>