<?php 
    $s = '../../database/database.php';
    $k = '../database/database.php';
    $t = './database/database.php';
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
    class Quyen extends Database{
        public function QuyenGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM quyen");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }
        public function QuyenAdd($tenquyen, $maquyen) {
            $add = $this->connect->prepare("INSERT INTO quyen(TENQUYEN, MAQUYEN) VALUES (?,?)");
            $add->execute(array($tenquyen, $maquyen));
            
            return $add->rowCount();
        }
        public function QuyenDelete($idquyen) {
            $del = $this->connect->prepare("DELETE FROM quyen WHERE ID_QUYEN = ?");
            $del->execute(array($idquyen));

            return $del->rowCount();
        }
        public function QuyenUpdate($tenquyen, $maquyen, $idquyen) {
            $update = $this->connect->prepare("UPDATE quyen SET TENQUYEN = ?, MAQUYEN = ?"
                                                . " WHERE ID_QUYEN = ?");
            $update->execute(array($tenquyen, $maquyen, $idquyen));
            
            return $update->rowCount();
        }
        public function QuyenGetbyId($idha) {
            $getQuyen = $this->connect->prepare("SELECT * FROM quyen WHERE ID_QUYEN = ?");
            $getQuyen->setFetchMode(PDO::FETCH_OBJ);
            $getQuyen->execute(array($idha));
            
            return $getQuyen->fetch();
        }
    }
?>