<?php 
    class Transactions{

        //Entities
        private $table = 'transactions';
        private $id = 'transac_id';
        private $customer = 'customer_id';
        private $employee = 'employee_id';
        private $product = 'product_id';
        private $address = 'address_id';
        private $quantity =  'transac_quantity';
        private $totalPrice = 'transac_totalPrice';
        private $status = 'transac_status';
        private $delivery = 'date_delivery';
        private $delivered = 'date_delivered' ;
        private $deleted = 'date_deleted';
        
        //Publics
        public function selectAll(){
            return $this->selectAllTotalPriceQuery();
        }

        public function getAllCustomerTransaction(){
            return $this->getAllCustomerTransactionQuery();
        }

        public function countRow(){
            return $this->countRowQuery();
        }

        public function orderToTransaction(){
            return $this->orderToTransactionQuery();
        }

        public function selectedUserTransaction(){
            return $this->selectedUserTransactionQuery();
        }

        public function getSeletedCustomerData(){
            return $this->getSeletedCustomerDataQuery();
        }

        public function getDateDelivery(){
            return $this->getDateDeliveryQuery();
        }

        public function onApprove(){
            return $this->onApproveQuery();
        }

        public function orderUpdateApproveAfterInsertionToTransaction(){
            return $this->orderUpdateApproveAfterInsertionToTransactionQuery();
        }

        //Privates
        private function selectAllTotalPriceQuery(){
            return 'SELECT SUM(o.order_quantity * p.productPrice) as transac_totalPrice FROM orders o INNER JOIN products p on o.product_id = p.product_id WHERE customer_id = ? and o.order_status = 1';
        }

        private function selectedUserTransactionQuery(){
            return 'SELECT transac_status, date_delivery FROM transactions WHERE customer_id = ? ORDER BY transac_id ASC LIMIT 1';
        }

        private function countRowQuery(){
            return "SELECT COUNT(*) FROM $this->table";
        }

        private function orderToTransactionQuery(){
            return "INSERT INTO `transactions` (`customer_id`, `employee_id`, `product_id`, `address_id`, `transac_quantity`, `transac_status`, `date_delivery`) SELECT customer_id, ?, product_id, address_id, order_quantity, ?, ? FROM orders WHERE customer_id = ? and id = ?;";
        }

        private function orderUpdateApproveAfterInsertionToTransactionQuery(){
            return "UPDATE products p JOIN (SELECT id, order_status ,product_id, customer_id, SUM(order_quantity) AS totalOrderQuantity FROM orders WHERE id = ? GROUP BY product_id) o on p.product_id = o.product_id SET p.productQuantity = p.productQuantity - o.totalOrderQuantity, p.productSales = p.productSales + o.totalOrderQuantity WHERE o.order_status = 1 AND o.id = ?";
        }

        private function getAllCustomerTransactionQuery(){
            return "SELECT t.transac_id, t.transac_quantity, t.date_delivery, t.transac_status, t.created_at, p.product_picture, p.productName, p.productPrice FROM `transactions` t INNER JOIN products p on t.product_id = p.product_id WHERE t.customer_id = ? ORDER BY t.created_at DESC";
        }

        private function getSeletedCustomerDataQuery(){
            return "SELECT t.transac_id, t.created_at, t.transac_quantity, t.transac_status, t.date_delivery, p.product_picture, p.productName, p.productPrice, a.address_region, a.address_province, a.address_city, a.address_barangay, a.address_street, a.address_zipCode FROM transactions t INNER JOIN products p INNER JOIN addresses a ON t.product_id = p.product_id AND t.address_id = a.address_id WHERE t.transac_id = ? AND t.customer_id = ?;";
        }

        private function getDateDeliveryQuery(){
            return "SELECT t.date_delivery AS deli, p.productName AS pn, u.username AS uname FROM `transactions` AS t INNER JOIN `products` AS p ON t.product_id = p.product_id INNER JOIN `users` AS u ON t.customer_id = u.user_id UNION SELECT re.dateDeliver as deli, re.Types as pn, u.username as uname FROM `request` AS re INNER JOIN `users` as u ON re.customer_id = u.user_id;";
        }

        private function onApproveQuery(){
            return "SELECT u.*, t.transac_id, t.transac_quantity, t.date_delivery, t.transac_status,  t.created_at, p.product_picture, p.productName, p.productPrice, a.address_region, a.address_province, a.address_city, a.address_barangay, a.address_street, a.address_zipCode FROM `transactions` AS t INNER JOIN `users` AS u INNER JOIN `addresses` AS a INNER JOIN `products` AS p on t.product_id = p.product_id AND t.customer_id = u.user_id AND t.address_id = a.address_id WHERE t.transac_id = ? ORDER BY t.created_at DESC";
        }
        
    }
?>