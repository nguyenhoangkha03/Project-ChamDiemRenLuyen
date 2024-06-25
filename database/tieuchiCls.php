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

    class Tieuchi extends Database{
        public function TieuChiGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM tieuchi");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function TieuChiAdd($tentc, $diemtoida) {
            $add = $this->connect->prepare("INSERT INTO tieuchi(TENTC, DIEMTOIDA) VALUES (?, ?)");
            $add->execute(array($tentc, $diemtoida));
            
            return $add->rowCount();
        }

        public function TieuChiDelete($id_tc) {
            $del = $this->connect->prepare("DELETE FROM tieuchi WHERE ID_TC = ?");
            $del->execute(array($id_tc));

            return $del->rowCount();
        }

        public function TieuChiUpdate($tentc, $diemtoida, $id_tc) {
            $update = $this->connect->prepare("UPDATE tieuchi SET TENTC = ?, DIEMTOIDA = ? WHERE ID_TC = ?");
            $update->execute(array($tentc, $diemtoida, $id_tc));
            
            return $update->rowCount();
        }

        public function TieuChiGetById($id_tc) {
            $getTieuChi = $this->connect->prepare("SELECT * FROM tieuchi WHERE ID_TC = ?");
            $getTieuChi->setFetchMode(PDO::FETCH_OBJ);
            $getTieuChi->execute(array($id_tc));
            
            return $getTieuChi->fetch();
        }
    }
?>