<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Addresses.php');

    class addressController{
        public function storeAddress($userid, $region, $province, $city, $barangay, $street, $zip){
            return $this->storingAddress($userid, $region, $province, $city, $barangay, $street, $zip);
        }

        public function getUserAddress($user_id){
            return $this->getThisUserAddress($user_id);
        }

        public function deleteAddress($id,$user_id){
            return $this->deleteThisAddress($id,$user_id);
        }

        private function storingAddress($userid, $region, $province, $city, $barangay, $street, $zip){
            try {
                $db = new Database();
                if($db->getStat()){
                    $add = new Addresses();
                    $stmt = $db->getCon()->prepare($add->storingAddress());
                    $stmt->execute(array($userid, $region, $province, $city, $barangay, $street, $zip));
                    $result = $stmt->fetch();
                    
                    if(!$result){
                        $db->closeCon();
                        return 200;
                    }else{
                        $db->closeCon();
                        return 401;
                    }
                    
                }else{
                    return 400;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }

        private function getThisUserAddress($user_id){
            try {
                $db = new Database();
                if($db->getStat()){
                    $add = new Addresses();
                    $stmt = $db->getCon()->prepare($add->getThisUserAddress());
                    $stmt->execute(array($user_id));
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

        private function deleteThisAddress($id,$user_id){
            try {
                $db = new Database();
                if($db->getStat()){
                    $add = new Addresses();
                    $stmt = $db->getCon()->prepare($add->deleteThisAddress());
                    $stmt->execute(array($id,$user_id));
                    $result = $stmt->fetch();
                    $db->closeCon();

                    if(!$result){
                        return 200;
                    }else{
                        return 400;
                    }

                }else{
                    return 400;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }
    }
?>