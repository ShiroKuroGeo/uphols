<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Products.php');

    class productController{

        // Publics
        public function getStoreProduct($product_picture, $productName, $productDescription, $productPrice, $productQuantity){
            return $this->storeProduct($product_picture, $productName, $productDescription, $productPrice, $productQuantity);
        }

        public function selectAllDisplayedProduct(){
            return $this->selectDisplayedProduct();
        }

        public function selectAllColumn(){
            return $this->selectAllColumnMethod();
        }
       
        public function selectAllRecommendedProduct(){
            return $this->selectRecommendedProduct();
        }

        public function showToOrder($product){
            return $this->selectedProduct($product);
        }

        public function countAllProduct(){
            return $this->getCountAllProduct();
        }

        public function selectAllProduct(){
            return $this->selectAllProductToAdmin();
        }

        public function selectlatestProduct(){
            return $this->selectlatestProducts();
        }
        
        public function getShowdDeleteProduct($ProductId){
            return $this->showdDeleteProduct($ProductId);
        }

        public function getDeleteSelectedProduct($ProductId){
            return $this->deleteSelectedProduct($ProductId);
        }

        public function updateSelectedProduct($ProductId, $productName, $productQuantity, $productPrice, $productStatus, $productDescription){
            return $this->getUpdateSelectedProduct($ProductId, $productName, $productQuantity, $productPrice, $productStatus, $productDescription);
        }


        //Privates

        private function storeProduct($product_picture, $productName, $productDescription, $productPrice, $productQuantity){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->storeProduct());
                    $stmt->execute(array($product_picture, $productName, $productDescription, $productPrice, $productQuantity));
                    $result = $stmt->fetch();
                    $db->closeCon();

                    if(!$result){
                        return 200;
                    }else{
                        return 401;
                    }

                }else{
                    return 400;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }

        private function selectDisplayedProduct(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->selectDisplayedProduct());
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

        private function selectAllColumnMethod(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->selectAllColumn());
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
        
        private function selectRecommendedProduct(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->selectRecommendedProduct());
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

        private function selectedProduct($product){
            try {
                $db = new Database();
                if($db->getStat()){
                    $products = new Products();

                    $stmt = $db->getCon()->prepare($products->selectedProduct());
                    $stmt->execute(array($product));
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

        private function getCountAllProduct(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $products = new Products();

                    $stmt = $db->getCon()->prepare($products->countRow());
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

        private function selectAllProductToAdmin(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->selectAll());
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

        private function selectlatestProducts(){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->selectlatestProducts());
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

        private function showdDeleteProduct($ProductId){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->showdDeleteProduct());
                    $stmt->execute(array($ProductId));
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

        private function deleteSelectedProduct($ProductId){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->deleteSelectedProduct());
                    $stmt->execute(array($ProductId));
                    $result = $stmt->fetchAll();
                    $db->closeCon();
                    
                    if(!$result){
                        return 200;
                    }else{
                        return 401;
                    }

                }else{
                    return 400;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }

        private function getUpdateSelectedProduct($ProductId, $productName, $productQuantity, $productPrice, $productStatus, $productDescription){
            try {
                $db = new Database();
                if($db->getStat()){
                    $product = new Products();

                    $stmt = $db->getCon()->prepare($product->updateSelectedProduct());
                    $stmt->execute(array($productName, $productQuantity, $productPrice, $productStatus, $productDescription, $ProductId));
                    $result = $stmt->fetchAll();
                    $db->closeCon();
                    
                    if(!$result){
                        return 200;
                    }else{
                        return 401;
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