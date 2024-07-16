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

    class Sinhvien extends Database{
        public function SinhVienGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM sinhvien");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function SinhVienAdd($masosv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, $isbch, $chucvu, $id_lop) {
            $add = $this->connect->prepare("INSERT INTO sinhvien(MASOSV, HOTEN, NGAYSINH, GIOITINH, DIACHI, SDT, EMAIL, HINHANH, ISBCH, CHUCVU, ID_LOP) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $add->execute(array($masosv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, $isbch, $chucvu, $id_lop));
            
            return $add->rowCount();
        }

        public function SinhVienDelete($id_sv) {
            $del = $this->connect->prepare("DELETE FROM sinhvien WHERE ID_SV = ?");
            $del->execute(array($id_sv));

            return $del->rowCount();
        }

        public function SinhVienUpdate($masosv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, $isbch, $chucvu, $id_lop, $id_sv) {
            $update = $this->connect->prepare("UPDATE sinhvien SET MASOSV = ?, HOTEN = ?, NGAYSINH = ?, GIOITINH = ?, DIACHI = ?, SDT = ?, EMAIL = ?, HINHANH = ?, ISBCH = ?, CHUCVU = ?, ID_LOP = ? WHERE ID_SV = ?");
            $update->execute(array($masosv, $hoten, $ngaysinh, $gioitinh, $diachi, $sdt, $email, $hinhanh, $isbch, $chucvu, $id_lop, $id_sv));
            
            return $update->rowCount();
        }

        public function SinhVienGetById($id_sv) {
            $getSinhVien = $this->connect->prepare("SELECT * FROM sinhvien WHERE ID_SV = ?");
            $getSinhVien->setFetchMode(PDO::FETCH_OBJ);
            $getSinhVien->execute(array($id_sv));
            
            return $getSinhVien->fetch();
        }

        public function SinhVienGetByIdLop($idlop) {
            $getSinhVien = $this->connect->prepare("SELECT * FROM sinhvien WHERE ID_LOP = ?");
            $getSinhVien->setFetchMode(PDO::FETCH_OBJ);
            $getSinhVien->execute(array($idlop));
            
            return $getSinhVien->fetchAll();
        }

        public function SinhVienGetByBCH() {
            $getSinhVien = $this->connect->prepare("SELECT * FROM sinhvien WHERE ISBCH = TRUE");
            $getSinhVien->setFetchMode(PDO::FETCH_OBJ);
            $getSinhVien->execute();
            
            return $getSinhVien->fetchAll();
        }

        public function SinhvienSearchName($text){
            $getSinhvien = $this->connect->prepare("select * from sinhvien where HOTEN LIKE '%$text%'");
            $getSinhvien->setFetchMode(PDO::FETCH_OBJ);
            $getSinhvien->execute();

            return $getSinhvien->fetchAll();
        }

        public function SinhvienSearchNameANDIDLop($text, $idlop){
            $getSinhvien = $this->connect->prepare("select * from sinhvien where HOTEN LIKE '%$text%' AND ID_LOP = ?");
            $getSinhvien->setFetchMode(PDO::FETCH_OBJ);
            $getSinhvien->execute(array($idlop));

            return $getSinhvien->fetchAll();
        }

        public function SinhvienIdLonNhat(){
            $getSv = $this->connect->prepare("select * from sinhvien WHERE ID_SV = (select max(ID_SV) from sinhvien)");
            $getSv->setFetchMode(PDO::FETCH_OBJ);
            $getSv->execute();
            
            return $getSv->fetch();
        }
    }
?>