<?php

    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Carts.php');

    class cartController{

        public function storeCart($user, $product){
            return $this->storingCart($user, $product);
        }

        public function viewMyCart($user){
            return $this->viewCart($user);
        }

        public function totalPriceCart($user){
            return $this->totalPriceCarts($user);
        }

        public function countSelectedCustomerCart($user){
            return $this->countAllCartFromCustomer($user);
        }

        public function destroySelectedCart($cart_id){
            return $this->destroyItem($cart_id);
        }

        public function updateThisCartQuality($user_id, $quantity, $cart_id){
            return $this->updateItem($user_id, $quantity, $cart_id);
        }

        public function storeAllSelectedCart($cartIds, $userId){
            $array = [0, $cartIds];
            $result = [];

            foreach ($array as $item) {
                if (is_string($item)) {
                    $subItems = explode(',', $item);
                    $result = array_merge($result, $subItems);
                } else {
                    $result[] = $item;
                }
            }

            $storeArray = $result;
            return $this->storingAllSelectedId($storeArray, $userId);
            
        }

        
        public function purchaseSelectedItem($cartIds, $address, $user_id){
            $array = [0, $cartIds];
            $result = [];

            foreach ($array as $item) {
                if (is_string($item)) {
                    $subItems = explode(',', $item);
                    $result = array_merge($result, $subItems);
                } else {
                    $result[] = $item;
                }
            }

            $storeArray = $result;
            return $this->purchaseItem($storeArray, $address, $user_id);
            
        }


        private function storingCart($user, $product){
            try {
                $db = new Database();
                if($db->getStat()){
                    $cart = new Carts();

                    $stmt = $db->getCon()->prepare($cart->storeCart());
                    $stmt->execute(array($user, $product));
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

        private function viewCart($user){
            try {
                $db = new Database();
                if($db->getStat()){
                    $cart = new Carts();
                    
                    $stmt = $db->getCon()->prepare($cart->viewCart());
                    $stmt->execute(array($user));
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

        private function totalPriceCarts($user){
            try {
                $db = new Database();
                if($db->getStat()){
                    $cart = new Carts();
                    
                    $stmt = $db->getCon()->prepare($cart->totalPriceCarts());
                    $stmt->execute(array($user));
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

        private function destroyItem($cart_id){
            try {
                $db = new Database();
                if($db->getStat()){
                    $cart = new Carts();
                    
                    $stmt = $db->getCon()->prepare($cart->destroyItem());
                    $stmt->execute(array($cart_id));
                    $result = $stmt->fetch();
                    
                    if(!$result){
                        $db->closeCon();
                        return 200;
                    }else{
                        $db->closeCon();
                        return 400;
                    }

                }else{
                    return 400;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }

        private function updateItem($user_id, $quantity, $cart_id){
            try {
                $db = new Database();
                if($db->getStat()){
                    $cart = new Carts();

                    $stmt = $db->getCon()->prepare($cart->updateItem());
                    $stmt->execute(array($user_id, $quantity, $cart_id));
                    $result = $stmt->fetch();
                    
                    if(!$result){
                        $db->closeCon();
                        return 200;
                    }else{
                        $db->closeCon();
                        return 400;
                    }

                }else{
                    return 400;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }

        private function countAllCartFromCustomer($user){
            try {
                $db = new Database();
                if($db->getStat()){
                    $cart = new Carts();
                    
                    $stmt = $db->getCon()->prepare($cart->countAllCartFromCustomer());
                    $stmt->execute(array($user));
                    $result = $stmt->fetch();
                    $db->closeCon();
                    return json_encode($result);

                }else{
                    return 400;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }

        private function storingAllSelectedId($cartIds, $userId) {
            try {
                $db = new Database();
                if ($db->getStat()) {
                    $cart = new Carts();
                    $stmt = $db->getCon()->prepare($cart->totalPriceSelectedId());
                    $prices = 0;

                    foreach ($cartIds as $cartId) {
                        if ($cartId !== 0) {
                            $stmt->execute(array($cartId, $userId));
                            while ($row = $stmt->fetch()) {
                                $prices += $row['Price'];
                            }
                        }
                    }
        
                    $db->closeCon();
                    return $prices;
                } else {
                    return 401;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }

        private function purchaseItem($cartIds, $address, $userId) {
            try {
                $db = new Database();
                if ($db->getStat()) {
                    $cart = new Carts();
                    $stmt = $db->getCon()->prepare($cart->storeSelectedItems());
                    $result = 0;

                    foreach ($cartIds as $cartId) {
                        if ($cartId !== 0) {
                            $stmt->execute(array($address, $cartId, $userId));
                            $result = $stmt->fetch();
                        }
                    }
        
                    $db->closeCon();

                    if(!$result){
                        return 200;
                    }else{
                        return 400;
                    }

                } else {
                    return 401;
                }
            } catch (PDOException $th) {
                return $th;
            }
        }
        

    }

?>