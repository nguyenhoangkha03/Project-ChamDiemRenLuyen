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
    class VBHD extends Database{
        public function VBHDGetAll(){
            $getAll = $this->connect->prepare("select * from vbhd");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }
        public function VBHDAdd($tenvbhd, $noidung, $ngaydang, $doluotxem, $id_sv) {
            $add = $this->connect->prepare("INSERT INTO vbhd(TENVBHD, NOIDUNG, NGAYDANG, SOLUOTXEM, ID_SV) VALUES (?,?,?,?,?)");
            $add->execute(array($tenvbhd, $noidung, $ngaydang, $doluotxem, $id_sv));
            
            return $add->rowCount();
        }
        public function VBHDDelete($id_vbhd) {
            $del = $this->connect->prepare("delete from vbhd where ID_VBHD = ?");
            $del->execute(array($id_vbhd));

            return $del->rowCount();
        }
        public function VBHDUpdate($tenvbhd, $noidung, $ngaydang, $doluotxem, $id_sv, $id_vbhd) {
            $update = $this->connect->prepare("UPDATE vbhd SET TENVBHD = ?, NOIDUNG = ?, NGAYDANG = ?, SOLUOTXEM = ?, ID_SV = ?"
                                                . " WHERE ID_VBHD = ?");
            $update->execute(array($tenvbhd, $noidung, $ngaydang, $doluotxem, $id_sv, $id_vbhd));
            
            return $update->rowCount();
        }
        public function VBHDGetbyId($id_vbhd) {
            $getCC = $this->connect->prepare("select * from vbhd where ID_VBHD=?");
            $getCC->setFetchMode(PDO::FETCH_OBJ);
            $getCC->execute(array($id_vbhd));
            
            return $getCC->fetch();
        }
        public function VBHDGetbyIdSV($id_sv) {
            $getCC = $this->connect->prepare("select * from vbhd where ID_SV=?");
            $getCC->setFetchMode(PDO::FETCH_OBJ);
            $getCC->execute(array($id_sv));
            
            return $getCC->fetchAll();
        }
    }
?>