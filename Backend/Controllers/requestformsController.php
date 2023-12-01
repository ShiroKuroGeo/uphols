<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/requestforms.php');

    class requestformsController{

        //Publics
        public function storeCustomization($types, $typePrice, $color, $colorPrice, $fabric, $fabricPrice){
            return $this->storeDesign($types, $typePrice, $color, $colorPrice, $fabric, $fabricPrice);
        }

        public function getSelectAllRequestForms(){
            return $this->selectAllRequestForms();
        }

        public function deleteDesignId($designId){
            return $this->deleteDesignUsingId($designId);
        }

        public function updateDesignId($types, $typePrice, $color, $colorPrice, $fabric, $fabricPrice, $designId){
            return $this->updateDesignUsingId($types, $typePrice, $color, $colorPrice, $fabric, $fabricPrice, $designId);
        }

        //Privates
        private function storeDesign($types, $typePrice, $color, $colorPrice, $fabric, $fabricPrice){
            try {
                $con = new Database();
                if($con->getStat()){
                    $req = new requestforms();
                    $stmt = $con->getCon()->prepare($req->storeDesign());
                    $stmt->execute(array($types, $typePrice, $color, $colorPrice, $fabric, $fabricPrice));
                    $result = $stmt->fetch();
                    $con->closeCon();

                    if(!$result){
                        return 200;
                    }else{
                        return 400;
                    }

                }else{
                    return 409;
                }
            } catch (Exception $th) {
                return $th;
            }
        }

        private function deleteDesignUsingId($designId){
            try {
                $con = new Database();
                if($con->getStat()){
                    $req = new requestforms();
                    $stmt = $con->getCon()->prepare($req->deleteDesignUsingId());
                    $stmt->execute(array($designId));
                    $result = $stmt->fetch();
                    $con->closeCon();

                    if(!$result){
                        return 200;
                    }else{
                        return 400;
                    }

                }else{
                    return 409;
                }
            } catch (Exception $th) {
                return $th;
            }
        }

        private function updateDesignUsingId($types, $typePrice, $color, $colorPrice, $fabric, $fabricPrice, $designId){
            try {
                $con = new Database();
                if($con->getStat()){
                    $req = new requestforms();
                    $stmt = $con->getCon()->prepare($req->updateDesignUsingId());
                    $stmt->execute(array($types, $typePrice, $color, $colorPrice, $fabric, $fabricPrice, $designId));
                    $result = $stmt->fetch();
                    $con->closeCon();

                    if(!$result){
                        return 200;
                    }else{
                        return 400;
                    }

                }else{
                    return 409;
                }
            } catch (Exception $th) {
                return $th;
            }
        }

        private function selectAllRequestForms(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $req = new requestforms();
                    $stmt = $db->getCon()->prepare($req->selectAll());
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    $db->closeCon();
                    return json_encode($result);

                }else{
                    return 400;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }

        
    }

?>