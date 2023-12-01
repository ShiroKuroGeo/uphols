<?php
    class Products{

        //Entities
        private $table = 'products';
        private $id = 'product_id';
        private $picture = 'product_picture'; 
        private $name = 'productName'; 
        private $description = 'productDescription'; 
        private $price = 'productPrice'; 
        private $quantity = 'productQuantity'; 
        private $status = 'productStatus'; 
        private $sales = 'productSales'; 

        //Publics
        public function selectAll(){
            return $this->selectAllQuery();
        }

        public function storeProduct(){
            return $this->storeProductQuery();
        }

        public function countRow(){
            return $this->countRowQuery();
        }

        public function selectDisplayedProduct(){
            return $this->selectDisplayedProductQuery();
        }
        
        public function selectRecommendedProduct(){
            return $this->selectRecommendedProductQuery();
        }

        public function selectedProduct(){
            return $this->selectedProductQuery();
        }

        public function showdDeleteProduct(){
            return $this->showdDeleteProductQuery();
        }

        public function deleteSelectedProduct(){
            return $this->deleteSelectedProductQuery();
        }

        public function selectlatestProducts(){
            return $this->selectlatestProductsQuery();
        }

        public function updateSelectedProduct(){
            return $this->updateSelectedProductQuery();
        }

        public function selectAllColumn(){
            return $this->selectAllColumnQuery();
        }
        
        //Privates
        private function selectAllQuery(){
            return "SELECT * FROM $this->table ORDER BY $this->id DESC";
        }

        private function selectDisplayedProductQuery(){
            return "SELECT * FROM $this->table WHERE $this->status <= 1";
        }

        private function selectRecommendedProductQuery(){
            return "SELECT * FROM $this->table WHERE $this->status = 0";
        }

        private function countRowQuery(){
            return "SELECT COUNT(*) as totalProductCount FROM $this->table";
        }

        private function selectedProductQuery(){
            return "SELECT * FROM $this->table WHERE $this->id = ?";
        }

        private function storeProductQuery(){
            return "INSERT INTO $this->table($this->picture, $this->name, $this->description, $this->price, $this->quantity, $this->status, $this->sales) VALUES (?,?,?,?,?,1,0)";
        }

        private function showdDeleteProductQuery(){
            return 'SELECT * FROM products WHERE product_id = ?';
        }

        private function deleteSelectedProductQuery(){
            return 'DELETE FROM products WHERE product_id = ?';
        }

        private function updateSelectedProductQuery(){
            return 'UPDATE products SET productName = ?, productQuantity = ?, productPrice = ?, productStatus = ?, productDescription = ? WHERE product_id = ?';
        }

        private function selectAllColumnQuery(){
            return "SELECT COUNT(o.id) as total FROM orders o UNION ALL SELECT COUNT(p.product_id) as total FROM products p UNION ALL SELECT COUNT(u.user_id) as total FROM users u WHERE u.role != 1 UNION ALL SELECT COUNT(r.id) as total FROM recommendations r;";
        }

        private function selectlatestProductsQuery(){
            return "SELECT * FROM $this->table ORDER BY created_at DESC LIMIT 5";
        }

    }
?>