<?php

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Orders.php');

class orderController
{

    public function countAllOrderFromCustomer($user_id)
    {
        return $this->countAll($user_id);
    }

    public function getCustomerOrder($user_id)
    {
        return $this->allCustomerOrder($user_id);
    }

    public function buyProduct($product, $address, $quantity, $user_id)
    {
        return $this->CustomerBuyProduct($product, $address, $quantity, $user_id);
    }

    public function getAllOrderFromCustomer()
    {
        return $this->countRowAdmin();
    }

    public function getSelectAllOrder()
    {
        return $this->selectAllOrder();
    }

    public function getOrderUserChart()
    {
        return $this->orderUserChartMethod();
    }

    public function getAllApproveCustomersOrder($status, $orderId, $customer, $gmail)
    {
        return $this->allApproveCustomersOrder($status, $orderId, $customer, $gmail);
    }

    public function getSelectedCustomerOrder($orderId)
    {
        return $this->selectedCustomerOrder($orderId);
    }

    public function getUpdateQuantityInApproval($orderId, $status, $customerId)
    {
        return $this->updateQuantityInApproval($orderId, $status, $customerId);
    }

    public function getUpdateQuantityInDecline($orderId, $status, $customerId)
    {
        return $this->updateQuantityInDecline($orderId, $status, $customerId);
    }

    public function requestCancel($status, $user_id){
        return $this->updateStatusRequest($status, $user_id);
    }
    
    public function cancelOrder($orderId){
        return $this->cancelOrderFunction($orderId);
    }

    private function countAll($user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();

                $stmt = $db->getCon()->prepare($order->countRow());
                $stmt->execute(array($user_id));
                $result = $stmt->fetch();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function allCustomerOrder($user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();

                $stmt = $db->getCon()->prepare($order->selectAll());
                $stmt->execute(array($user_id));
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function CustomerBuyProduct($product, $address, $quantity, $user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();
                $stmt = $db->getCon()->prepare($order->buyThisProduct());
                $stmt->execute(array($user_id, $product, $address, $quantity));
                $result = $stmt->fetch();
                $db->closeCon();

                if (!$result) {
                    return 200;
                } else {
                    return 400;
                }
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function countRowAdmin()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();
                $stmt = $db->getCon()->prepare($order->countRowAdmin());
                $stmt->execute();
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function selectAllOrder()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();

                $stmt = $db->getCon()->prepare($order->selectAllOrder());
                $stmt->execute();
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function selectedCustomerOrder($orderId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();

                $stmt = $db->getCon()->prepare($order->selectedCustomerOrder());
                $stmt->execute(array($orderId));
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function orderUserChartMethod()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();

                $stmt = $db->getCon()->prepare($order->orderUserChart());
                $stmt->execute();
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function updateQuantityInApproval($orderId, $status, $customerId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();
                $stmt = $db->getCon()->prepare($order->updateQuantityInApproval());
                $stmt->execute(array($status, $orderId, $customerId, $orderId, $customerId, $status));
                $result = $stmt->fetch();
                $db->closeCon();

                if (!$result) {
                    return 200;
                } else {
                    return 400;
                }
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function updateQuantityInDecline($orderId, $status, $customerId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();
                $stmt = $db->getCon()->prepare($order->updateQuantityInDecline());
                $stmt->execute(array($status, $orderId, $customerId));
                $result = $stmt->fetch();
                $db->closeCon();

                if (!$result) {
                    return 200;
                } else {
                    return 400;
                }
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }
    
    private function cancelOrderFunction($orderId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();
                $stmt = $db->getCon()->prepare($order->cancelOrderFunction());
                $stmt->execute(array($orderId));
                $result = $stmt->fetch();
                $db->closeCon();

                if (!$result) {
                    return 200;
                } else {
                    return 400;
                }
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function allApproveCustomersOrder($status, $orderId, $customer, $gmail)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $order = new Orders();
                $stmt = $db->getCon()->prepare($order->allApproveCustomersOrder());
                $stmt->execute(array($status, $orderId, $customer));
                $result = $stmt->fetch();
                $db->closeCon();

                if (!$result) {
                    date_default_timezone_set('Asia/Manila');
                    $date = new DateTime('now');
                    $today = $date->format('Y-m-d H:i:s');
                    $email = require __DIR__ . "/mailer.php";
                    $email->setFrom('VILLARUBIAUPHOLSTERY@gmail.com');
                    $email->addAddress($gmail);
                    $email->isHTML(true);
                    $email->Subject = 'Your Item is......';
                    $email->Body = <<<END
                            Thank you for shopping on Villarubia Service and Repair. <br><br>

                            Your order has been <span style="color: blue;">Approved</span>.<br><br>

                            <b>Approved Date:</b> $today<br>
                            <b>Email:</b> $gmail<br><br>

                            We will send the date delivery soon on the website that you can view in your services.<br><br>

                            For futher assistance, please contact me using the number of <b>09484750030</b> or come at our shop in<br>
                            <b>Bangbang Poblacion Cordova Cebu</b> at the back of <b>Cordova Gaisano Grand Mall.</b><br><br>

                            Truly yours,<br>
                            Villarubia's Upholstery Service and Repair Shop.<br>

                            Your order has been Approve and will be deliver.<br><br>
                            Please wait for the call anytime soon or contact me<br><br>
                            Contact Number: 09484750030<br>
                            Messenger: Shiro George Alfeser
                        END;

                    $email->send();

                    return 200;
                } else {
                    return 400;
                }
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function updateStatusRequest($status, $user_id){
        // try {
        //     $db = new Database();
        //     if($db->getStat()){
        //         $order = new Orders();
        //         $stmt = $db->getCon()->prepare($order->updateStatusRequest());
        //         $stmt->execute(array($status, $user_id));
        //         $result = $stmt->fetch();
        //         $db->closeCon();

        //         if(!$result){
        //             return 200;
        //         }else{
        //             return 400;
        //         }
        //     }else{
        //         return 401;
        //     }
        // } catch (PDOException $th) {
        //     return $th;
        // }
    }

}
