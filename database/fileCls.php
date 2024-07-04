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
    class File extends Database{
        public function FileGetAll(){
            $getAll = $this->connect->prepare("SELECT * FROM file");
            $getAll->setFetchMode(PDO::FETCH_OBJ);
            $getAll->execute();

            return $getAll->fetchAll();
        }

        public function FileAdd($filename, $filefile, $idvbhd){
            $add = $this->connect->prepare("INSERT INTO file(FILENAME, FILEFILE, ID_VBHD) VALUES (?,?,?)");
            $add->execute(array($filename, $filefile, $idvbhd));
            
            return $add->rowCount();
        }
        public function FileDelete($idfile) {
            $del = $this->connect->prepare("DELETE FROM file WHERE ID_FILE = ?");
            $del->execute(array($idfile));

            return $del->rowCount();
        }
        public function FileUpdate($filefile, $idvbhd,$idfile) {
            $update = $this->connect->prepare("UPDATE file SET FILEFILE = ?, ID_VBHD = ?"
                                                . " WHERE ID_FILE = ?");
            $update->execute(array($filefile, $idvbhd,$idfile));
            
            return $update->rowCount();
        }
        public function FileGetbyId($idfile) {
            $getFILE = $this->connect->prepare("SELECT * FROM file WHERE ID_FILE = ?");
            $getFILE->setFetchMode(PDO::FETCH_OBJ);
            $getFILE->execute(array($idfile));
            
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