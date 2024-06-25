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
    class TieuchiCT extends Database{
        public function TieuchiCTGetAll(){
            $getAll = $this->connect->prepare("select * from tieuchict");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }
        public function TieuchiCTAdd($tentcct, $idtc) {
            $add = $this->connect->prepare("INSERT INTO tieuchict(TENTCCT,ID_TC) VALUES (?,?)");
            $add->execute(array($tentcct, $idtc));
            
            return $add->rowCount();
        }
        public function TieuchiCTDelete($idtcct) {
            $del = $this->connect->prepare("delete from tieuchict where ID_TCCT=?");
            $del->execute(array($idtcct));

            return $del->rowCount();
        }
        public function TieuchiCTUpdate($tentcct,$idtc,$idtcct) {
            $update = $this->connect->prepare("UPDATE tieuchict SET TENTCCT = ?, ID_TC = ?"
                                                . " WHERE ID_TCCT = ?");
            $update->execute(array($tentcct,$idtc,$idtcct));
            
            return $update->rowCount();
        }
        public function TieuchiCTGetbyId($idtcct) {
            $getCC = $this->connect->prepare("select * from tieuchict where ID_TCCT=?");
            $getCC->setFetchMode(PDO::FETCH_OBJ);
            $getCC->execute(array($idtcct));
            
            return $getCC->fetch();
        }
        public function TieuchiCTGetbyIDTC($idtc) {
            $getCC = $this->connect->prepare("select * from tieuchict where ID_TC=?");
            $getCC->setFetchMode(PDO::FETCH_OBJ);
            $getCC->execute(array($idtc));
            
            return $getCC->fetchAll();
        }
        
    }
?>