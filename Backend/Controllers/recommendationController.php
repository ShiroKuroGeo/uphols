<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Recommendation.php');

    class recommendationController{
             
        //Publics

        public function recommendation($fullname, $email, $phone, $message){
            return $this->AuthRecommendation($fullname, $email, $phone, $message);
        }

        public function selectAllRecommendation(){
            return $this->getAllRecommendation();
        }

        public function selectedRecommend($recommend_id){
            return $this->selectedRecommendation($recommend_id);
        }

        public function countAllRecommendation(){
            return $this->getCountAllRecommendation();
        }

        //Privates

        private function AuthRecommendation($fullname, $email, $phone, $message){
            try {
                $con = new Database();
                if($con->getStat()){
                    $rec = new Recommendation();
                    $stmt = $con->getCon()->prepare($rec->doRecommendation());
                    $stmt->execute(array($fullname, $email, $phone, $message));
                    $result = $stmt->fetch();
                    if(!$result){
                        $con->closeCon();
                        return 200;
                    }else{
                        $con->closeCon();
                        return "400";
                    }
                }else{
                    return 409;
                }
            } catch (Exception $th) {
                return $th;
            }
        }

        private function getAllRecommendation(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $recommend = new Recommendation();
                    $stmt = $db->getCon()->prepare($recommend->selectAllRecommendation());
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

        private function selectedRecommendation($recommend_id){
            try {
                $db = new Database();
                if($db->getStat()){
                    $recommend = new Recommendation();
                    $stmt = $db->getCon()->prepare($recommend->selectedRecommendation());
                    $stmt->execute(array($recommend_id));
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

        private function getCountAllRecommendation(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $recommend = new Recommendation();
                    $stmt = $db->getCon()->prepare($recommend->countRow());
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