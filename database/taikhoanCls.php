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

    class Taikhoan extends Database{
        public function TaiKhoanGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM taikhoan");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function TaiKhoanAdd($username, $password, $ngaycap, $trangthai, $id_sv, $id_quyen) {
            $add = $this->connect->prepare("INSERT INTO taikhoan(USERNAME, PASSWORD, NGAYCAP, TRANGTHAI, ID_SV, ID_QUYEN) VALUES (?,?,?,?,?,?)");
            $add->execute(array($username, $password, $ngaycap, $trangthai, $id_sv, $id_quyen));
            
            return $add->rowCount();
        }

        public function TaiKhoanDelete($id_tk) {
            $del = $this->connect->prepare("DELETE FROM taikhoan WHERE ID_TK = ?");
            $del->execute(array($id_tk));

            return $del->rowCount();
        }

        public function TaiKhoanUpdate($username, $password, $ngaycap, $trangthai, $id_sv, $id_quyen, $id_tk) {
            $update = $this->connect->prepare("UPDATE taikhoan SET USERNAME = ?, PASSWORD = ?, NGAYCAP = ?, TRANGTHAI = ?, ID_SV = ?, ID_QUYEN = ? WHERE ID_TK = ?");
            $update->execute(array($username, $password, $ngaycap, $trangthai, $id_sv, $id_quyen, $id_tk));
            
            return $update->rowCount();
        }

        public function TaiKhoanUpdatePass($password, $id_tk) {
            $update = $this->connect->prepare("UPDATE taikhoan SET PASSWORD = ? WHERE ID_TK = ?");
            $update->execute(array($password, $id_tk));
            
            return $update->rowCount();
        }

        public function TaiKhoanGetById($id_tk) {
            $getTaiKhoan = $this->connect->prepare("SELECT * FROM taikhoan WHERE ID_TK = ?");
            $getTaiKhoan->setFetchMode(PDO::FETCH_OBJ);
            $getTaiKhoan->execute(array($id_tk));
            
            return $getTaiKhoan->fetch();
        }

        public function TaiKhoanGetByIdSV($id_sv) {
            $getTaiKhoan = $this->connect->prepare("SELECT * FROM taikhoan WHERE ID_SV = ?");
            $getTaiKhoan->setFetchMode(PDO::FETCH_OBJ);
            $getTaiKhoan->execute(array($id_sv));
            
            return $getTaiKhoan->fetchAll();
        }

        public function TaiKhoanGetByUsername($username) {
            $getTaiKhoan = $this->connect->prepare("SELECT * FROM taikhoan WHERE USERNAME = ?");
            $getTaiKhoan->setFetchMode(PDO::FETCH_OBJ);
            $getTaiKhoan->execute(array($username));
            
            return $getTaiKhoan->fetch();
        }

        public function TaikhoanCheckLogin($username, $password){
            $getTK = $this->connect->prepare("SELECT * FROM taikhoan WHERE USERNAME = ? AND PASSWORD = ?");
            $getTK->setFetchMode(PDO::FETCH_OBJ);
            $getTK->execute(array($username, $password));

            return $getTK->fetch();
        }
    }
?>