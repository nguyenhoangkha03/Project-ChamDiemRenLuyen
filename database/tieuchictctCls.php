<?php 
    $s = '../../database-query/database.php';
    $k = '../database-query/database.php';
    $t = './database-query/database.php';
    if(file_exists($s)){
        $f = $s;
    }
    else if(file_exists($k)){
        $f = $k;
    }
    else{
        $f = $t;
    }
    require_once $f;
    class TieuchiCTCT extends Database{
        public function TieuchiCTCTGetAll(){
            $getAll = $this->connect->prepare("select * from tieuchictct");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }
        public function TieuchiCTCTAdd($tentcctct,$haveminhchung, $idtcct) {
            $add = $this->connect->prepare("INSERT INTO tieuchictct(TENTCCTCT,HAVEMINHCHUNG,ID_TCCT) VALUES (?,?,?)");
            $add->execute(array($tentcctct,$haveminhchung, $idtcct));
            
            return $add->rowCount();
        }
        public function TieuchiCTCTDelete($idtcctct) {
            $del = $this->connect->prepare("delete from tieuchictct where ID_TCCTCT=?");
            $del->execute(array($idtcctct));

            return $del->rowCount();
        }
        public function TieuchiCTCTUpdate($tentcctct,$haveminhchung, $idtcct,$idtcctct) {
            $update = $this->connect->prepare("UPDATE tieuchictct SET TENTCCTCT = ?, HAVAMINHCHUNG = ?, ID_TCCT = ?"
                                                . " WHERE ID_TCCTCT = ?");
            $update->execute(array($tentcctct,$haveminhchung, $idtcct,$idtcctct));
            
            return $update->rowCount();
        }
        public function TieuchiCTCTGetbyId($idtcctct) {
            $getCC = $this->connect->prepare("select * from tieuchictct where ID_TCCTCT=?");
            $getCC->setFetchMode(PDO::FETCH_OBJ);
            $getCC->execute(array($idtcctct));
            
            return $getCC->fetch();
        }        
    }
?>