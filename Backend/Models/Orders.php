<?php
    class Orders{

        //Entities
        private $table = 'orders';
        private $id = 'id';
        private $customer = 'customer_id';
        private $product = 'product_id';
        private $quantity = 'order_quantity';
        private $order_status = 'order_status';


        //Publics
        public function selectAll(){
            return $this->selectAllQuery();
        }

        public function cancelOrderFunction(){
            return $this->cancelOrderFunctionQuery();
        }

        public function selectAllOrder(){
            return $this->selectAllOrderQuery();
        }

        public function updateQuantityInApproval(){
            return $this->updateQuantityInApprovalQuery();
        }

        public function updateQuantityInDecline(){
            return $this->updateQuantityInDeclineQuery();
        }

        public function countRow(){
            return $this->countRowQuery();
        }

        public function buyThisProduct(){
            return $this->buyThisProductQuery();
        }

        public function countRowAdmin(){
            return $this->countRowQueryAdmin();
        }

        public function selectedCustomerOrder(){
            return $this->selectedCustomerOrderQuery();
        }

        public function allApproveCustomersOrder(){
            return $this->allApproveCustomersOrderQuery();
        }

        public function orderUserChart(){
            return $this->orderUserChartQuery();
        }


        private function selectAllQuery(){
            return "SELECT p.product_picture, p.productName, p.productDescription, p.productPrice, p.productQuantity, p.productStatus, p.productSales, o.order_quantity, o.order_status, o.id FROM orders o RIGHT JOIN products p on o.product_id = p.product_id WHERE o.customer_id = ? AND o.order_status != 2";
        }

        private function selectAllOrderQuery(){
            return "SELECT o.customer_id, o.order_status, u.firstname, u.lastname FROM orders o INNER JOIN users u on o.customer_id = u.user_id GROUP BY o.customer_id;";
        }

        private function updateQuantityInApprovalQuery(){
            return "UPDATE orders SET order_status = ? WHERE id = ? AND customer_id = ?;
            
            UPDATE products p JOIN (SELECT id, order_status ,product_id, customer_id, SUM(order_quantity) AS totalOrderQuantity FROM orders GROUP BY product_id) o on p.product_id = o.product_id SET p.productQuantity = p.productQuantity - o.totalOrderQuantity, p.productSales = p.productSales + o.totalOrderQuantity WHERE o.id = ? AND o.customer_id = ? AND o.order_status = ?";
        }

        private function updateQuantityInDeclineQuery(){
            return "UPDATE orders SET order_status = ? WHERE id = ? AND customer_id = ?;";
        }

        private function selectedCustomerOrderQuery(){
            return "SELECT o.id, o.customer_id, o.product_id,  o.address_id,  o.order_quantity,  o.order_status,  o.created_at, o.updated_at, u.firstname, u.lastname, u.email, u.phone, p.product_picture, p.productName, p.productDescription, p.productPrice, p.productQuantity, p.productStatus, p.productSales, a.address_region, a.address_province, a.address_city, a.address_barangay, a.address_street, a.address_zipCode FROM orders o INNER JOIN users u INNER JOIN products p INNER JOIN addresses a  on o.customer_id = u.user_id AND o.product_id = p.product_id and o.address_id = a.address_id WHERE o.customer_id = ?";
        }

        private function countRowQuery(){
            return "SELECT COUNT(*) as totalNumber FROM $this->table WHERE $this->customer = ?";
        }

        private function buyThisProductQuery(){
            return "INSERT INTO `orders`(`customer_id`, `product_id`, `address_id`, `order_quantity`, `order_status`) VALUES (?,?,?,?,3)";
        }

        private function countRowQueryAdmin(){
            return "SELECT * FROM $this->table";
        }

        private function allApproveCustomersOrderQuery(){
            return "UPDATE $this->table SET $this->order_status = ? WHERE $this->id = ? AND $this->customer = ?";
        }

        private function orderUserChartQuery(){
            return "SELECT EXTRACT(MONTH FROM created_at) AS current_month, COUNT(*) AS totalIds FROM orders GROUP BY EXTRACT(MONTH FROM created_at) ORDER BY MAX(created_at) DESC LIMIT 5;";
        }

        private function cancelOrderFunctionQuery(){
            return "DELETE FROM `orders` WHERE `id` = ?";
        }

    }
?>