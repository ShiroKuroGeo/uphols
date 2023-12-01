<?php
    class Request{

        private $table = 'request';
        private $id = 'id';
        private $customer = 'customer_id';
        private $address = 'address_id';
        private $Types = 'Types';
        private $color = 'color';
        private $fabric = 'fabric';
        private $paymentTotalPrice = 'paymentTotalPrice';
        private $message = 'message';
        private $paymentMethod =  'paymentMethod';
        private $status = 'status';

        public function storeRequest(){
            return $this->storeRequestQuery();
        }

        public function infoRequest(){
            return $this->getInfoRequestQuery();
        }

        public function scheduleRepairFunction(){
            return $this->scheduleRepairFunctionQuery();
        }

        public function allInfoRequest(){
            return $this->getAllInforOfRequestQuery();
        }

        public function updateStatus(){
            return $this->updateStatusQuery();
        }

        public function dateAndTotalId(){
            return $this->dateAndTotalIdQuery();
        }

        public function customerRequest(){
            return $this->customerRequestQuery();
        }

        public function storeScheduleRepairFunction(){
            return $this->storeScheduleRepairFunctionQuery();
        }

        private function storeRequestQuery(){
            return "INSERT INTO `request`(`customer_id`,  `address_id`,  `Types`,  `color`,  `fabric`,  `message`,  `paymentMethod`,  `paymentTotalPrice`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        }

        private function storeScheduleRepairFunctionQuery(){
            return 'UPDATE `request` SET `Types`= ? ,`color`= ? ,`fabric`= ? ,`message`= ? ,`paymentMethod`= ? ,`paymentTotalPrice`= ? , `date`= ?, `status` = 1 WHERE id = ?';
        }

        private function scheduleRepairFunctionQuery(){
            return "INSERT INTO `request`(`customer_id`, `address_id`, `status`) VALUES (?, ?, 5);";
        }
        
        private function getInfoRequestQuery(){
            return "SELECT r.id, r.status, u.lastname, u.firstname FROM request as r INNER JOIN users as u ON r.customer_id = u.user_id;";
        }
        
        private function updateStatusQuery(){
            return "UPDATE request as r SET r.status = ?, r.dateDeliver = ? WHERE r.id = ?";
        }
        
        private function customerRequestQuery(){
            return "SELECT r.*, a.address_province, a.address_city, a.address_barangay, a.address_street FROM `request` r INNER JOIN `addresses` a ON r.address_id = a.address_id WHERE r.customer_id = ?";
        }
        
        private function getAllInforOfRequestQuery(){
            return "SELECT r.dateDeliver, r.id, r.Types, r.color, r.message, r.paymentMethod, r.status, r.created_at, u.firstname, u.lastname, u.phone, u.email, ad.address_region, ad.address_province, ad.address_city, ad.address_barangay, ad.address_street, ad.address_zipCode FROM request as r INNER JOIN users as u INNER JOIN addresses as ad ON r.customer_id = u.user_id AND r.address_id = ad.address_id WHERE r.id = ?;";
        }
        
        private function dateAndTotalIdQuery(){
            return "SELECT EXTRACT(MONTH FROM created_at) AS current_month, COUNT(*) AS totalIds FROM request GROUP BY EXTRACT(MONTH FROM created_at) ORDER BY MAX(created_at) DESC LIMIT 4";
        }

    }
?>