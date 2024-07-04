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
    class Hinhanh extends Database{
        public function HinhanhGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM hinhanh");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function HinhanhAdd($filehinh, $idvbhd){
            $add = $this->connect->prepare("INSERT INTO hinhanh(FILEHINH, ID_VBHD) VALUES (?,?)");
            $add->execute(array($filehinh, $idvbhd));
            
            return $add->rowCount();
        }
        public function HinhanhDelete($idha) {
            $del = $this->connect->prepare("DELETE FROM hinhanh WHERE ID_HA = ?");
            $del->execute(array($idha));

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

        public function HinhanhGetbyIdVBHD($idvbhd) {
            $getHinhanh = $this->connect->prepare("SELECT * FROM hinhanh WHERE ID_VBHD = ?");
            $getHinhanh->setFetchMode(PDO::FETCH_OBJ);
            $getHinhanh->execute(array($idvbhd));
            
            return $getHinhanh->fetchAll();
        }
    }
?>