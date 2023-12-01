<?php
    class Recommendation{

        // Entities
        private $table = 'recommendations';
        private $pk = 'id';
        private $fn = 'fullname';
        private $ml = 'email';
        private $pn = 'phoneNumber';
        private $msg = 'message';
        
        //Publics
        public function selectAllRecommendation(){
            return $this->selectAllRecommendationQuery();
        }

        public function doRecommendation(){
            return $this->recommendationQuery();
        }

        public function countRow(){
            return $this->countRowQuery();
        }

        public function selectedRecommendation(){
            return $this->selectedRecommendationQuery();
        }
        
        
        //Privates
        private function selectAllRecommendationQuery(){
            return "SELECT * FROM $this->table";
        }

        private function recommendationQuery(){
            return "INSERT INTO $this->table($this->fn, $this->ml, $this->pn, $this->msg) VALUES (?,?,?,?)";
        }

        private function countRowQuery(){
            return "SELECT COUNT(*) as totalRecommendationCount FROM $this->table";
        }

        private function selectedRecommendationQuery(){
            return "SELECT * FROM $this->table WHERE $this->pk = ?";
        }
    }
?>