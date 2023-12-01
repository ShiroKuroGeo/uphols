<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/Database.php');
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Models/User.php');

class userController
{

    // publics
    public function login($username, $password)
    {
        return $this->AuthLogin($username, $password);
    }

    public function forgotPassword($email)
    {
        return $this->AuthForgotPassword($email);
    }

    public function viewMyCart($user)
    {
        return $this->viewCart($user);
    }

    public function getCustomerOrder($user_id)
    {
        return $this->allCustomerOrder($user_id);
    }

    public function register($firstname, $lastname, $username, $password, $email, $phone, $profile)
    {
        return $this->AuthRegister($firstname, $lastname, $username, $password, $email, $phone, $profile);
    }

    public function changePasswordFromForgotPassword($newpass, $id, $forgotPassword)
    {
        return $this->changePasswordFromForgotPasswordMethod($newpass, $id, $forgotPassword);
    }

    public function allUser()
    {
        return $this->selectAllUser();
    }

    public function latestCustomer()
    {
        return $this->selectlatestCustomer();
    }

    public function userSelected($user_id)
    {
        return $this->selectedUser($user_id);
    }

    public function countAllMyTotalRequest($user_id)
    {
        return $this->countAllTotalRequest($user_id);
    }

    public function getCode($code)
    {
        return $this->getCodeMethod($code);
    }

    public function updateStatus($status, $user_id)
    {
        return $this->updateUserStatus($status, $user_id);
    }

    public function countAllUsers()
    {
        return $this->countUsers();
    }

    public function verifyEmail($verificationEmail, $email)
    {
        return $this->verifyEmailFunction($verificationEmail, $email);
    }

    public function customersInformation($user_id)
    {
        return $this->customersInformations($user_id);
    }

    public function changePasswordUsingGmail($gmail)
    {
        return $this->changePasswordUsingGmailFunction($gmail);
    }

    public function updateInformation($firstname, $lastname, $email, $username, $phone, $user_id)
    {
        return $this->updateInformations($firstname, $lastname, $email, $username, $phone, $user_id);
    }

    public function changeProfile($user_id, $profile)
    {
        return $this->updateProfile($user_id, $profile);
    }

    public function checkOldPassword($oldPass, $user_id)
    {
        return $this->oldPassword($oldPass, $user_id);
    }

    public function changePassword($newPassword, $oldPassword, $userid)
    {
        return $this->updatePassword($newPassword, $oldPassword, $userid);
    }

    public function changePasswordQueryEmail($token, $pass)
    {
        return $this->changePasswordQueryEmailFunction($token, $pass);
    }

    // Privates
    private function AuthLogin($username, $password)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $users = new User();
                $passEncryp = md5($password);
                $stmt = $db->getCon()->prepare($users->doLogin());
                $stmt->execute(array($username, $username, $passEncryp));
                $role = null;
                $status = null;
                $verify = null;

                while ($row = $stmt->fetch()) {
                    $role = $row['role'];
                    $verify = $row['verifyEmail'];
                    $status = $row['status'];
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['profile'] = $row['profilePicture'];
                }

                if ($role > 0) {
                    if ($role == '3') {
                        if ($status == '1') {
                            if ($verify == null) {
                                $_SESSION['user_id'];
                                $db->closeCon();
                                return 3;
                            } else {
                                return 5;
                            }
                        } else {
                            $db->closeCon();
                            return "Unactive!";
                        }
                    } else if ($role == '2') {
                        if ($status == '1') {
                            $_SESSION['user_id'];
                            $db->closeCon();
                            return 2;
                        } else {
                            $db->closeCon();
                            return "Deleted!";
                        }
                    } else if ($role == '1') {
                        $_SESSION['user_id'];
                        $db->closeCon();
                        return 1;
                    } else {
                        $db->closeCon();
                        return 400;
                    }
                } else {
                    $db->closeCon();
                    return "No Data";
                }
            } else {
                return 409;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function AuthRegister($firstname, $lastname, $username, $password, $email, $phone, $profile)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();

                $tryEmail = $db->getCon()->prepare($user->doEmailExisted());
                $tryEmail->execute(array($email));
                $emaillExist = $tryEmail->fetch();

                if (!$emaillExist) {
                    $encrypt = md5($password);

                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $code = '';
                    for ($i = 1; $i <= 10; $i++) {
                        $code .= $characters[rand(0, strlen($characters) - 1)];
                    }

                    $random_number = random_int(100000, 999999);

                    $profileDefualt = '';

                    if ($profile != '') {
                        $profileDefualt = $profile;
                    } else {
                        $profileDefualt = 'DefualtProfile.png';
                    }

                    $stmt = $db->getCon()->prepare($user->doRegister());
                    $stmt->execute(array($firstname, $lastname, $username, $encrypt, $email, $phone, $profileDefualt, $code, $random_number));
                    $result = $stmt->fetch();

                    if (!$result) {
                        $db->closeCon();
                        date_default_timezone_set('Asia/Manila');
                        $date = new DateTime('now');
                        $today = $date->format('Y-m-d H:i:s');

                        $emails = require __DIR__ . "/mailer.php";
                        $emails->setFrom("NOREPLY@example.com");
                        $emails->addAddress($email);
                        $emails->Subject = "Email Verification Villarubia Upholstery";
                        $emails->Body = <<<END
                            Thank you for registering on Villarubia Service and Repair. <br><br>

                            Your verification code is<br> <span style="color: red; font-size: 20px"> $random_number </span>.<br><br>
                            
                            <b>Verification Date Sends:</b> $today<br>
                            <b>Verification Email:</b> $email<br><br>
                            
                            Thank you for your support for <b>UPHOLSTERY SERVICE AND REPAIR</b><br><br>
                            
                            For futher assistance, please contact me using the number of <b>09484750030</b> or come at our shop in<br>
                            <b>Bangbang Poblacion Cordova Cebu</b> at the back of <b>Cordova Gaisano Grand Mall.</b><br><br>
                            
                            Truly yours,<br>
                            Villarubia's Upholstery Service and Repair Shop.<br>
                            END;
                        $emails->send();
                        return 200;
                    } else {
                        $db->closeCon();
                        return 400;
                    }
                } else {
                    return 401;
                }
            } else {
                return 409;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function selectAllUser()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->selectAllUsers());
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

    private function selectedUser($user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->selectedUser());
                $stmt->execute(array($user_id));
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

    private function updateUserStatus($status, $user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();

                $stmt = $db->getCon()->prepare($user->updateStatus());
                $stmt->execute(array($status, $user_id));
                $result = $stmt->fetch();

                if (!$result) {
                    $db->closeCon();
                    return 200;
                } else {
                    $db->closeCon();
                    return 401;
                }
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function countUsers()
    {
        try {

            $db = new Database();

            if ($db->getStat()) {

                $user = new User();
                $stmt = $db->getCon()->prepare($user->countUsers());
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

    private function AuthForgotPassword($email)
    {
        try {

            $db = new Database();

            if ($db->getStat()) {

                $user = new User();
                $stmt = $db->getCon()->prepare($user->confimPassword());
                $stmt->execute(array($email));
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

    private function customersInformations($user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->customersInformations());
                $stmt->execute(array($user_id));
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

    private function updateInformations($firstname, $lastname, $email, $username, $phone, $user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();

                $stmt = $db->getCon()->prepare($user->updateInformations());
                $stmt->execute(array($firstname, $lastname, $email, $username, $phone, $user_id));
                $result = $stmt->fetch();

                if (!$result) {
                    $db->closeCon();
                    return 200;
                } else {
                    $db->closeCon();
                    return 401;
                }
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function updateProfile($user_id, $profile)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();

                $stmt = $db->getCon()->prepare($user->updateProfile());
                $stmt->execute(array($profile, $user_id));
                $result = $stmt->fetch();

                if (!$result) {
                    $db->closeCon();
                    return 200;
                } else {
                    $db->closeCon();
                    return 401;
                }
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function updatePassword($newPassword, $oldPassword, $userid)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $newMd5 = md5($newPassword);
                $stmt = $db->getCon()->prepare($user->changePassword());
                $stmt->execute(array($newMd5, $userid, $oldPassword));
                $result = $stmt->fetch();

                $db->closeCon();

                if (!$result) {
                    return 200;
                } else {
                    return 401;
                }
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function changePasswordFromForgotPasswordMethod($newpass, $id, $forgotPassword)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $newMd5 = md5($newpass);
                $stmt = $db->getCon()->prepare($user->changePasswordFromForgotPassword());
                $stmt->execute(array($newMd5, $id, $forgotPassword));
                $result = $stmt->fetch();

                $db->closeCon();

                if (!$result) {
                    return 200;
                } else {
                    return 401;
                }
            } else {
                return 400;
            }
        } catch (PDOException $th) {
            return $th;
        }
    }

    private function oldPassword($oldPass, $user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $oldPassMd5 = md5($oldPass);
                $stmt = $db->getCon()->prepare($user->oldPassword());
                $stmt->execute(array($oldPassMd5, $user_id));
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

    private function getCodeMethod($code)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->getCode());
                $stmt->execute(array($code));
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

    private function countAllTotalRequest($user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->countAllTotalRequest());
                $stmt->execute(array($user_id));
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

    private function selectlatestCustomer()
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->selectlatestCustomer());
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

    private function allCustomerOrder($user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->allCustomerOrder());
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

    private function viewCart($user_id)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->viewCart());
                $stmt->execute(array($user_id));
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

    private function changePasswordQueryEmailFunction($token, $pass)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->changePasswordQueryEmail());
                $stmt->execute(array(md5($pass), $token));
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

    private function verifyEmailFunction($verificationEmail, $email)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->verifyEmail());
                $stmt->execute(array($verificationEmail, $email));
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

    private function changePasswordUsingGmailFunction($gmail)
    {
        try {
            $db = new Database();
            if ($db->getStat()) {
                $user = new User();
                $stmt = $db->getCon()->prepare($user->changePasswordUsingGmail());
                $reset_token = bin2hex(random_bytes(16));
                $token = hash("sha256", $reset_token);
                $stmt->execute(array($token, $gmail));
                $result = $stmt->fetch();
                $db->closeCon();

                if (!$result) {
                    date_default_timezone_set('Asia/Manila');
                    $date = new DateTime('now');
                    $today = $date->format('Y-m-d H:i:s');

                    $email = require __DIR__ . "/mailer.php";
                    $email->setFrom("NOREPLY@example.com");
                    $email->addAddress($gmail);
                    $email->Subject = "Password Reset Villarubia Upholstery";
                    $email->Body = <<<END
                                To reset your password, Click here <a href="http://localhost/uphols/Authentication/forgotPasswordConfiguration/changepasswordusinggmail.php?resetToken=$token"><span style="color: blue;">Reset Password</span></a><br><br>

                                <b>Reset Password Date:</b>$today<br>
                                <b>Email:</b>$gmail<br><br>

                                We will send the date delivery soon on the website that you can view in your cart.<br><br>

                                For futher assistance, please contact me using the number of <b>09484750030</b> or come at our shop in<br>
                                <b>Bangbang Poblacion Cordova Cebu</b> at the back of <b>Cordova Gaisano Grand Mall.</b><br><br>

                                Truly yours,<br>
                                Villarubia's Upholstery Service and Repair Shop.<br>
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
}
