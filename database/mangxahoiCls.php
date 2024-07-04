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
    class MXH extends Database{
        public function MXHGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM maxahoi");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function MXHAdd($linkface, $linkins, $idsv){
            $add = $this->connect->prepare("INSERT INTO maxahoi(LINKFACEBOOK, LINKINSTAGRAM, ID_SV) VALUES (?,?,?)");
            $add->execute(array($linkface, $linkins, $idsv));
            
            return $add->rowCount();
        }
        public function MXHDelete($idmxh) {
            $del = $this->connect->prepare("DELETE FROM maxahoi WHERE ID_MXH = ?");
            $del->execute(array($idmxh));

            return $del->rowCount();
        }
        public function MXHUpdate($linkface, $linkins, $idsv, $idmxh) {
            $update = $this->connect->prepare("UPDATE maxahoi SET LINKFACEBOOK = ?, LINKINSTAGRAM = ?, ID_SV = ?"
                                                . " WHERE ID_MXH = ?");
            $update->execute(array($linkface, $linkins, $idsv, $idmxh));
            
            return $update->rowCount();
        }
        public function MXHGetbyId($idmxh) {
            $getLop = $this->connect->prepare("SELECT * FROM maxahoi WHERE ID_MXH = ?");
            $getLop->setFetchMode(PDO::FETCH_OBJ);
            $getLop->execute(array($idmxh));
            
            return $getLop->fetch();
        }
        public function MXHGetByIDSV($idsv){
            $getLop = $this->connect->prepare("SELECT * FROM maxahoi WHERE ID_SV = ?");
            $getLop->setFetchMode(PDO::FETCH_OBJ);
            $getLop->execute(array($idsv));

            return $getLop->fetch();
        }
    }
?>