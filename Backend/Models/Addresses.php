<?php
    class Addresses{

        //Entities
        private $table = 'addresses';
        private $id = 'address_id';
        private $userid = 'user_id';
        private $region = 'address_region';
        private $province = 'address_province';
        private $city = 'address_city';
        private $barangay = 'address_barangay';
        private $street = 'address_street';
        private $zip = 'address_zipCode';

        //Publics
        public function getThisUserAddress(){
            return $this->selectAllQuery();
        }

        public function countRow(){
            return $this->countRowQuery();
        }
        
        public function storingAddress(){
            return $this->storeAddress();
        }
        
        public function deleteThisAddress(){
            return $this->deleteThisAddressQuery();
        }

        //Privates
        private function selectAllQuery(){
            return "SELECT * FROM $this->table WHERE $this->userid = ?";
        }

        private function storeAddress(){
            return "INSERT INTO $this->table ($this->userid, $this->region, $this->province, $this->city, $this->barangay, $this->street, $this->zip) VALUES(?,?,?,?,?,?,?)";
        }
        
        private function countRowQuery(){
            return "SELECT COUNT(*) FROM $this->table";
        }
        
        private function deleteThisAddressQuery(){
            return "DELETE FROM $this->table WHERE $this->id = ? AND $this->userid = ?";
        }
    }
?>