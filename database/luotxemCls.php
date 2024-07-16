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
    class Luotxem extends Database{
        public function LuotxemGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM luotxem");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function LuotxemGetAllByIDVBHD($idvbhd){
            $getAll = $this->connect->prepare("SELECT * FROM luotxem WHERE ID_VBHD = ?");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute(array($idvbhd));

            return $getAll->fetchAll();
        }

        public function LuotxemGetAllByIDSV($idsv){
            $getAll = $this->connect->prepare("SELECT * FROM luotxem WHERE ID_SV = ?");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute(array($idsv));

            return $getAll->fetchAll();
        }

        public function LuotxemGetAllByIDSVANDIDVBHD($idsv, $idvbhd){
            $getAll = $this->connect->prepare("SELECT * FROM luotxem WHERE ID_SV = ? AND ID_VBHD = ?");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute(array($idsv, $idvbhd));

            return $getAll->fetch();
        }

        public function LuotxemAdd($idsv, $idvbhd){
            $add = $this->connect->prepare("INSERT INTO luotxem(ID_SV, ID_VBHD) VALUES (?,?)");
            $add->execute(array($idsv, $idvbhd));
            
            return $add->rowCount();
        }
        public function LuotxemDelete($idlx) {
            $del = $this->connect->prepare("DELETE FROM luotxem WHERE ID_LX = ?");
            $del->execute(array($idlx));

            return $del->rowCount();
        }
        public function LuotxemUpdate($idlx) {
            $update = $this->connect->prepare("UPDATE luotxem SET ID_SV = null"
                                                . " WHERE ID_LX = ?");
            $update->execute(array($idlx));
            
            return $update->rowCount();
        }
        public function LikeGetbyId($idlike) {
            $getFILE = $this->connect->prepare("SELECT * FROM likes WHERE ID_LIKE = ?");
            $getFILE->setFetchMode(PDO::FETCH_OBJ);
            $getFILE->execute(array($idlike));
            
            return $getFILE->fetch();
        }

        public function FileGetbyIdVBHD($idvbhd) {
            $getFILE = $this->connect->prepare("SELECT * FROM file WHERE ID_VBHD = ?");
            $getFILE->setFetchMode(PDO::FETCH_OBJ);
            $getFILE->execute(array($idvbhd));
            
            return $getFILE->fetchAll();
        }
    }
?>