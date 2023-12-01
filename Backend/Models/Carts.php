<?php
    class Carts {

        private $table = 'carts';
        private $pk = 'cart_id ';
        private $user = 'user_id';
        private $prod = 'product_id';
        private $quan = 'quantityCart';
        private $stat = 'statusCart';
        private $crea = 'created_at';
        private $upda = 'updated_at';

        // Publics
        public function selectAllCart(){
            return $this->selectAllCartQuery();
        }

        public function countAllCart(){
            return $this->countAllCartQuery();
        }

        public function storeCart(){
            return $this->storeCartQuery();
        }

        public function viewCart(){
            return $this->viewCartQuery();
        }

        public function totalPriceCarts(){
            return $this->totalPriceCartsQuery();
        }

        public function destroyItem(){
            return $this->destroyItemQuery();
        }

        public function updateItem(){
            return $this->updateItemQuery();
        }

        public function countAllCartFromCustomer(){
            return $this->countAllCartFromCustomerQuery();
        }

        public function totalPriceSelectedId(){
            return $this->totalPriceSelectedIdQuery();
        }

        public function storeSelectedItems(){
            return $this->storeSelectedItemsQuery();
        }

        // Privates
        private function selectAllCartQuery(){
            return "SELECT * FROM $this->table";
        }

        private function countAllCartQuery(){
            return "SELECT COUNT(*) FROM $this->table";
        }

        private function countAllCartFromCustomerQuery(){
            return "SELECT COUNT(*) as totalCount FROM $this->table WHERE $this->user = ?";
        }

        private function storeCartQuery(){
            return "INSERT INTO $this->table ($this->user, $this->prod) VALUES (?,?)";
        }

        private function viewCartQuery(){
            return "SELECT c.cart_id, c.user_id, c.product_id, c.quantityCart, c.statusCart, p.product_picture, p.productName, p.productPrice FROM `carts` as c INNER JOIN `products` as p ON c.product_id = p.product_id WHERE c.user_id = ? ORDER BY c.created_at DESC;";
        }

        private function totalPriceCartsQuery(){
            return "SELECT SUM(c.quantityCart * p.productPrice) as totalPrice FROM `carts` as c INNER JOIN `products` as p ON c.product_id = p.product_id WHERE c.user_id = ?";
        }

        private function destroyItemQuery(){
            return "DELETE FROM $this->table WHERE $this->pk = ?";
        }

        private function updateItemQuery(){
            return "UPDATE $this->table SET $this->user = ?, $this->quan = ? WHERE $this->pk = ?";
        }

        private function totalPriceSelectedIdQuery(){
            return "SELECT SUM(c.quantityCart * p.productPrice) as Price FROM carts c INNER JOIN products p INNER JOIN users u on c.product_id = p.product_id WHERE c.cart_id = ? and U.user_id = ?";
        }

        private function storeSelectedItemsQuery(){
            return "INSERT INTO orders (`customer_id`, `address_id`, `product_id`, `order_quantity`) SELECT `user_id`, ?, `product_id`, `quantityCart` FROM carts WHERE `cart_id` = ? AND `user_id` = ?";
        }
    }
?>