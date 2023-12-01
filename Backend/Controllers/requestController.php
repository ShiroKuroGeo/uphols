<?php

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Request.php');
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/vendor/autoload.php');

class requestController
{

    //Publics
    public function getStoreRequest($customer_id, $address_id, $Types, $color, $fabric, $message, $paymentMethod, $paymentTotalPrice)
    {
        return $this->storeRequest($customer_id, $address_id, $Types, $color, $fabric, $message, $paymentMethod, $paymentTotalPrice);
    }

    public function doStoreScheduleRepairFunction($id, $Types, $color, $fabric, $message, $paymentMethod, $paymentTotalPrice, $date)
    {
        return $this->storeScheduleRepairFunction($id, $Types, $color, $fabric, $message, $paymentMethod, $paymentTotalPrice, $date);
    }

    public function getSelectAllRequestForms()
    {
        return $this->selectAllRequestForms();
    }

    public function getInfoRequest()
    {
        return $this->getInfoRequestMethod();
    }

    public function getAllInfoRequest($id)
    {
        return $this->getAllInfoRequestMethod($id);
    }

    public function scheduleRepair($user_id, $address)
    {
        return $this->scheduleRepairFunction($user_id, $address);
    }

    public function getCustomerRequest($id)
    {
        return $this->customerRequest($id);
    }

    public function updateStatus($id, $status, $dateDeliver, $gmail)
    {
        return $this->updateStatusMethod($id, $status, $dateDeliver, $gmail);
    }

    public function getDateAndTotalId()
    {
        return $this->dateAndTotalIdMethod();
    }

    //Privates
    private function storeRequest($customer_id, $address_id, $Types, $color, $fabric, $message, $paymentMethod, $paymentTotalPrice)
    {
        try {

            $con = new Database();
            if ($con->getStat()) {
                $req = new Request();
                $stmt = $con->getCon()->prepare($req->storeRequest());
                $stmt->execute(array($customer_id, $address_id, $Types, $color, $fabric, $message, $paymentMethod, $paymentTotalPrice));
                $result = $stmt->fetch();
                $con->closeCon();


                if (!$result) {
                    if ($paymentMethod == 'COD') {
                        return 200;
                    } else {

                        $client = new \GuzzleHttp\Client();
                        $totalAmount = $paymentTotalPrice * 100;
                        $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
                            'json' => [
                                'data' => [
                                    'attributes' => [
                                        'amount' => $totalAmount,
                                        'description' => $message
                                    ]
                                ]
                            ],
                            'headers' => [
                                'accept' => 'application/json',
                                'authorization' => 'Basic c2tfdGVzdF9oY1NxTjNUVVFuS2tHWXREMlo5Y29OY0w6',
                                'content-type' => 'application/json',
                            ],
                        ]);
                        $result = json_decode($response->getBody(), true);
                        $checkoutUrl = $result['data']['attributes']['checkout_url'];

                        return $checkoutUrl;
                    }
                } else {
                    return 400;
                }
            } else {
                return 409;
            }
        } catch (Exception $th) {
            return $th;
        }
    }
    private function storeScheduleRepairFunction($id, $Types, $color, $fabric, $message, $paymentMethod, $paymentTotalPrice, $date)
    {
        try {
            $con = new Database();
            if ($con->getStat()) {
                $req = new Request();
                $stmt = $con->getCon()->prepare($req->storeScheduleRepairFunction());
                $stmt->execute(array($Types, $color, $fabric, $message, $paymentMethod, $paymentTotalPrice, $date, $id));
                $result = $stmt->fetch();
                $con->closeCon();

                if (!$result) {
                    return 200;
                } else {
                    return 400;
                }
            } else {
                return 409;
            }
        } catch (Exception $th) {
            return $th;
        }
    }

    private function selectAllRequestForms()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $req = new requestforms();
                $stmt = $db->getCon()->prepare($req->selectAll());
                $stmt->execute();
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function updateStatusMethod($id, $status, $dateDeliver, $gmail)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $req = new Request();
                $stmt = $db->getCon()->prepare($req->updateStatus());
                $stmt->execute(array($status, $dateDeliver, $id));
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
                    $email->Subject = 'Your Customized Item is......';
                    $email->Body = <<<END
                            Thank you for selecting Villarubia Service and Repair. <br><br>

                            Your customized has been <span style="color: blue;">Approved</span> and will be delivered at $dateDeliver<br><br>

                            <b>Approved Date:</b> $today<br>
                            <b>Email:</b> $gmail<br><br>

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
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function scheduleRepairFunction($user_id, $address)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $req = new Request();
                $stmt = $db->getCon()->prepare($req->scheduleRepairFunction());
                $stmt->execute(array($user_id, $address));
                $result = $stmt->fetch();
                $db->closeCon();

                if (!$result) {
                    return 200;
                } else {
                    return 400;
                }
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function getInfoRequestMethod()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $req = new Request();
                $stmt = $db->getCon()->prepare($req->infoRequest());
                $stmt->execute();
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function getAllInfoRequestMethod($id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $req = new Request();
                $stmt = $db->getCon()->prepare($req->allInfoRequest());
                $stmt->execute(array($id));
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function customerRequest($id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $req = new Request();
                $stmt = $db->getCon()->prepare($req->customerRequest());
                $stmt->execute(array($id));
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function dateAndTotalIdMethod()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $req = new Request();
                $stmt = $db->getCon()->prepare($req->dateAndTotalId());
                $stmt->execute();
                $result = $stmt->fetchAll();
                $db->closeCon();
                return json_encode($result);
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }
}
