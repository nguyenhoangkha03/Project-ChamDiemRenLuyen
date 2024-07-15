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
    class Bangdiem extends Database{
        public function BangdiemGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM bangdiem");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function BangdiemAdd($hocky, $namhoc, $tongdiemsv, $diemdiemlop, $tongdiemkhoa, $idsv, $tungay, $denngay){
            $add = $this->connect->prepare("INSERT INTO bangdiem(HOCKY, NAMHOC, TONGDIEMSV, TONGDIEMLOP, TONGDIEMKHOA, ID_SV, TUNGAY, DENNGAY) VALUES (?,?,?,?,?,?,?,?)");
            $add->execute(array($hocky, $namhoc, $tongdiemsv, $diemdiemlop, $tongdiemkhoa, $idsv, $tungay, $denngay));
            
            return $add->rowCount();
        }

        public function BangdiemAddByBCH($hocky, $namhoc, $tungay, $denngay, $idsv, $isnew, $open){
            $add = $this->connect->prepare("INSERT INTO bangdiem(HOCKY, NAMHOC, TUNGAY, DENNGAY, ID_SV, ISNEW, OPEN) VALUES (?,?,?,?,?,?,?)");
            $add->execute(array($hocky, $namhoc, $tungay, $denngay, $idsv, $isnew, $open));
            
            return $add->rowCount();
        }

        public function BangdiemDelete($idbd) {
            $del = $this->connect->prepare("DELETE FROM bangdiem WHERE ID_BD = ?");
            $del->execute(array($idbd));

            return $del->rowCount();
        }

        public function BangdiemUpdate($hocky, $namhoc, $tongdiemsv, $diemdiemlop, $tongdiemkhoa, $idsv, $idbd) {
            $update = $this->connect->prepare("UPDATE bangdiem SET HOCKY = ?, NAMHOC = ?, TONGDIEMSV = ?, TONGDIEMLOP = ?, TONGDIEMKHOA = ?, ID_SV = ?"
                                                . " WHERE ID_BD = ?");
            $update->execute(array($hocky, $namhoc, $tongdiemsv, $diemdiemlop, $tongdiemkhoa, $idsv, $idbd));
            
            return $update->rowCount();
        }

        public function BangdiemUpdateTONGDIEMLOP($diemdiemlop, $idbd) {
            $update = $this->connect->prepare("UPDATE bangdiem SET TONGDIEMLOP = ?"
                                                . " WHERE ID_BD = ?");
            $update->execute(array($diemdiemlop, $idbd));
            
            return $update->rowCount();
        }

        public function BangdiemGetbyCheckBoth($isnew, $open) {
            $getBD = $this->connect->prepare("SELECT * FROM bangdiem WHERE ISNEW = ? AND OPEN = ?");
            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute(array($isnew, $open));
            
            return $getBD->fetch();
        }


        public function BangdiemGetbyCheckNew() {
            $getBD = $this->connect->prepare("SELECT * FROM bangdiem WHERE ISNEW = 1");
            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute();
            
            return $getBD->fetch();
        }

        public function BangdiemLock($idbd) {
            $update = $this->connect->prepare("UPDATE bangdiem SET OPEN = 0 WHERE ID_BD = ?");
            $update->execute(array($idbd));
            
            return $update->rowCount();
        }

        public function BangdiemOpen($idbd) {
            $update = $this->connect->prepare("UPDATE bangdiem SET OPEN = 1 WHERE ID_BD = ?");
            $update->execute(array($idbd));
            
            return $update->rowCount();
        }


        public function BangdiemGetbyId($idbd) {
            $getBD = $this->connect->prepare("SELECT * FROM bangdiem WHERE ID_BD = ?");
            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute(array($idbd));
            
            return $getBD->fetch();
        }

        public function BangdiemAllNHHK() {
            $getBD = $this->connect->prepare("SELECT DISTINCT HOCKY, NAMHOC FROM bangdiem ORDER BY NAMHOC DESC, HOCKY DESC");
            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute();
            
            return $getBD->fetchAll();
        }

        public function BangdiemLastOfIDSV($idsv) {
            $getBD = $this->connect->prepare("SELECT * FROM bangdiem WHERE ID_BD = (SELECT max(ID_BD) FROM bangdiem WHERE ID_SV = ?)");
            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute(array($idsv));
            
            return $getBD->fetch();
        }

        public function BangdiemGetByNamHocAndIDSV($namhoc, $idsv) {
            $getBD = $this->connect->prepare("SELECT * FROM bangdiem WHERE NAMHOC = ? AND ID_SV = ?");
            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute(array($namhoc, $idsv));
            
            return $getBD->fetchAll();
        }

        public function BangdiemGetbyIdSVAndNHAndHK($idsv,$namhoc, $hocky) {
            $getBD = $this->connect->prepare("SELECT * FROM bangdiem WHERE ID_SV = ? AND NAMHOC = ? AND HOCKY = ?");

            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute(array($idsv, $namhoc, $hocky));
            
            return $getBD->fetch();
        }

        public function BangdiemGetbyNHAndHKOrderbyLOP($hocky, $namhoc) {
            $getBD = $this->connect->prepare("SELECT lop.ID_LOP, lop.TENLOP, COUNT(sinhvien.ID_SV) AS SOLUONG
                                              FROM bangdiem INNER JOIN sinhvien ON bangdiem.ID_SV = sinhvien.ID_SV
                                                            INNER JOIN lop ON sinhvien.ID_LOP = lop.ID_LOP
                                              WHERE bangdiem.HOCKY = ? AND bangdiem.NAMHOC = ? AND bangdiem.TONGDIEMKHOA IS NOT NULL AND bangdiem.TONGDIEMKHOA != 0
                                              GROUP BY lop.ID_LOP, lop.TENLOP");

            $getBD->setFetchMode(PDO::FETCH_OBJ);
            $getBD->execute(array($hocky, $namhoc));
            
            return $getBD->fetchAll();
        }
    }
?>