<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Transactions.php');

class transactionController
{

    public function getOrderToTransaction($approvedBy, $status, $customerId, $orderId)
    {
        return $this->orderToTransaction($approvedBy, $status, $customerId, $orderId);
    }

    public function getSelectAll($customerId)
    {
        return $this->selectAll($customerId);
    }

    public function getSelectedUserTransaction($customerId)
    {
        return $this->selectedUserTransaction($customerId);
    }

    public function seletedCustomerData($transac_id, $user_id)
    {
        return $this->getSeletedCustomerData($transac_id, $user_id);
    }

    public function AllCustomerTransaction($customerId)
    {
        return $this->getAllCustomerTransaction($customerId);
    }

    public function onApprove($tId)
    {
        return $this->onApproveFunction($tId);
    }

    public function getDateDelivery()
    {
        return $this->getDateDeliveryFunction();
    }

    private function orderToTransaction($approvedBy, $status, $customerId, $orderId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $transaction = new Transactions();

                $stmt = $db->getCon()->prepare($transaction->orderToTransaction());
                $stmt->execute(array($approvedBy, $status, $this->setDateAdvanceTo7Days(), $customerId, $orderId));
                $result = $stmt->fetch();

                if (!$result && $status == 1) {
                    $transaction = new Transactions();

                    $stmt = $db->getCon()->prepare($transaction->orderUpdateApproveAfterInsertionToTransaction());
                    $stmt->execute(array($orderId, $orderId));
                    $result = $stmt->fetch();
                    $db->closeCon();

                    if (!$result) {
                        return 200;
                    } else {
                        return 400;
                    }
                } else {
                    $db->closeCon();
                    return 400;
                }
            } else {
                return 401;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function selectAll($customerId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $transaction = new Transactions();
                $stmt = $db->getCon()->prepare($transaction->selectAll());
                $stmt->execute(array($customerId));
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

    private function selectedUserTransaction($customerId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $transaction = new Transactions();
                $stmt = $db->getCon()->prepare($transaction->selectedUserTransaction());
                $stmt->execute(array($customerId));
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

    private function getAllCustomerTransaction($customerId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $transaction = new Transactions();
                $stmt = $db->getCon()->prepare($transaction->getAllCustomerTransaction());
                $stmt->execute(array($customerId));
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

    private function getSeletedCustomerData($transac_id, $user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $transaction = new Transactions();

                $stmt = $db->getCon()->prepare($transaction->getSeletedCustomerData());
                $stmt->execute(array($transac_id, $user_id));
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

    private function getDateDeliveryFunction()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $transaction = new Transactions();

                $stmt = $db->getCon()->prepare($transaction->getDateDelivery());
                $stmt->execute(array());
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

    private function onApproveFunction($tId)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $transaction = new Transactions();

                $stmt = $db->getCon()->prepare($transaction->onApprove());
                $stmt->execute(array($tId));
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

    private function setDateAdvanceTo7Days()
    {
        $currentDate = new DateTime();

        $sevenDaysAgo = $currentDate->add(new DateInterval('P6D'));

        $formattedDate = $sevenDaysAgo->format('Y-m-d H:i:s');

        return $formattedDate;
    }
}
