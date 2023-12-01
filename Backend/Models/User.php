<?php
    class User{

        // Entities
        private $table = 'users';
        private $pk = 'user_id';
        private $fn = 'firstname';
        private $ln = 'lastname';
        private $user = 'username';
        private $pass = 'password';
        private $email = 'email';
        private $phone = 'phone';
        private $stat = 'status';
        private $forgotCode = 'code';
        private $role = 'role';
        private $pp = 'profilePicture';

        // Publics
        public function selectAllUsers(){
            return $this->selectAllUsersQuery();
        }

        public function doLogin(){
            return $this->login();
        }

        public function doRegister(){
            return $this->register();
        }

        public function viewCart(){
            return $this->viewCartQuery();
        }

        public function confimPassword(){
            return $this->confimPasswordQuery();
        }

        public function getCode(){
            return $this->getCodeQuery();
        }

        public function changePasswordFromForgotPassword(){
            return $this->changePasswordFromForgotPasswordQuery();
        }

        public function doEmailExisted(){
            return $this->emailExisted();
        }

        public function selectedUser(){
            return $this->selectedUserQuery();
        }

        public function countAllTotalRequest(){
            return $this->countAllTotalRequestQuery();
        }

        public function updateStatus(){
            return $this->updateStatusQuery();
        }

        public function countUsers(){
            return $this->countUsersQuery();
        }

        public function customersInformations(){
            return $this->customersInformationQuery();
        }

        public function updateInformations(){
            return $this->updateInformationsQuery();
        }

        public function updateProfile(){
            return $this->updateProfileQuery();
        }

        public function oldPassword(){
            return $this->oldPasswordQuery();
        }   

        public function verifyEmail(){
            return $this->verifyEmailQuery();
        }   

        public function changePassword(){
            return $this->changePasswordQuery();
        }

        public function selectlatestCustomer(){
            return $this->selectlatestCustomerQuery();
        }

        public function allCustomerOrder(){
            return $this->selectAllQuery();
        }

        public function changePasswordUsingGmail(){
            return $this->changePasswordUsingGmailQuery();
        }

        public function changePasswordQueryEmail(){
            return $this->changePasswordQueryEmailQuery();
        }

        // Privates
        private function selectAllUsersQuery(){
            return "SELECT * FROM $this->table WHERE $this->role >= 2 ORDER BY $this->pk DESC";
        }

        private function login(){
            return "SELECT * FROM $this->table WHERE ($this->user = ? or $this->email = ?) AND $this->pass = ?";
        }

        private function register(){
            return "INSERT INTO $this->table ($this->fn, $this->ln, $this->user, $this->pass, $this->email, $this->phone, $this->stat, $this->role, $this->pp, $this->forgotCode, `verifyEmail`) VALUES (?, ?, ?, ?, ?, ?, '1', '3', ?, ?, ?)";
        }

        private function emailExisted(){
            return "SELECT * FROM $this->table WHERE $this->email = ?";
        }

        private function selectedUserQuery(){
            return "SELECT u.`user_id`, u.`firstname`, u.`lastname`, u.`username`, u.`password`, u.`email`, u.`phone`, u.`status`, u.`code`, u.`role`, u.`profilePicture`, u.`created_at`, u.`updated_at`, IFNULL(c.cart_count, 0) as totalCart, IFNULL(o.order_count, 0) as totalOrders FROM users u LEFT JOIN ( SELECT user_id, COUNT(cart_id) as cart_count FROM carts GROUP BY user_id ) c ON u.user_id = c.user_id LEFT JOIN ( SELECT customer_id, COUNT(id) as order_count FROM orders GROUP BY customer_id ) o ON u.user_id = o.customer_id WHERE u.user_id = ?";
        }

        private function updateStatusQuery(){
            return "UPDATE $this->table SET $this->stat = ? WHERE $this->pk = ?";
        }

        private function countUsersQuery(){
            return "SELECT COUNT(*) as userCount FROM $this->table WHERE $this->role >= 2";
        }

        private function customersInformationQuery(){
            return "SELECT * FROM $this->table WHERE $this->pk = ?";
        }

        private function updateInformationsQuery(){
            return "UPDATE $this->table SET $this->fn = ?, $this->ln = ?, $this->email = ?, $this->user = ?, $this->phone = ? WHERE $this->pk = ?";
        }

        private function updateProfileQuery(){
            return "UPDATE $this->table SET $this->pp = ? WHERE $this->pk = ?";
        }

        private function changePasswordQuery(){
            return "UPDATE $this->table SET $this->pass = ? WHERE $this->pk = ? AND $this->pass = ?";
        }

        private function oldPasswordQuery(){
            return "SELECT password FROM users WHERE password = ? AND user_id = ?";
        }

        private function confimPasswordQuery(){
            return "SELECT * FROM $this->table WHERE $this->email = ?";
        }

        private function getCodeQuery(){
            return "SELECT $this->pk, $this->forgotCode FROM $this->table WHERE $this->forgotCode = ?";
        }
    
        private function changePasswordFromForgotPasswordQuery(){
            return "UPDATE `users` SET `password`= ? WHERE `user_id`= ? AND `code`= ?";
        }
    
        private function countAllTotalRequestQuery(){
            return "SELECT COUNT(*) as totalRequest FROM `request` WHERE status = 2 AND customer_id = ?";
        }
    
        private function selectlatestCustomerQuery(){
            return "SELECT * FROM $this->table ORDER BY created_at DESC LIMIT 5";
        }
    
        private function viewCartQuery(){
            return "SELECT c.cart_id, c.user_id, c.product_id, c.quantityCart, c.statusCart, p.product_picture, p.productName, p.productPrice, c.created_at FROM `carts` as c INNER JOIN `products` as p ON c.product_id = p.product_id WHERE c.user_id = ? ORDER BY c.created_at DESC";
        }

        private function selectAllQuery(){
            return "SELECT p.product_picture, p.productName, p.productDescription, p.productPrice, p.productQuantity, p.productStatus, p.productSales, o.order_quantity, o.order_status, o.id, o.created_at FROM orders o RIGHT JOIN products p on o.product_id = p.product_id WHERE o.customer_id = ? ORDER BY o.created_at DESC";
        }

        private function changePasswordUsingGmailQuery(){
            return "UPDATE `users` SET `reset_password` = ? WHERE `email` = ?";
        }

        private function changePasswordQueryEmailQuery(){
            return "UPDATE `users` SET `password` = ? WHERE `reset_password` = ?";
        }

        private function verifyEmailQuery(){
            return "UPDATE `users` set `verifyEmail` = '' WHERE `verifyEmail` = ? AND `email` = ?";
        }
    }
?>