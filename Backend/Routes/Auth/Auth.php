<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/userController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function login(){
        $user = new userController();
        echo $user->login($_POST['Username'], $_POST['Password']);
    }

    function forgotPassword(){
        $user = new userController();
        echo $user->forgotPassword($_POST['email']);
    }

    function getCode(){
        $user = new userController();
        echo $user->getCode($_POST['code']);
    }

    function changePasswordUsingGmail(){
        $user = new userController();
        echo $user->changePasswordUsingGmail($_POST['gmail']);
    }

    function changeMyPassword(){
        $user = new userController();
        echo $user->changePasswordQueryEmail($_POST['resetToken'], $_POST['newPassword']);
    }

    function changePasswordFromForgotPassword(){
        $user = new userController();
        echo $user->changePasswordFromForgotPassword($_POST['newpass'], $_POST['id'], $_POST['forgotPassword']);
    }

    function verifyEmail(){
        $user = new userController();
        echo $user->verifyEmail($_POST['verificationEmail'], $_POST['email']);
    }

    function register(){
        $user = new userController();

        $location = $_SERVER['DOCUMENT_ROOT'] . "/Uphols/Assets/Images/";
        $profile = '';
        if(isset($_FILES['file']['name'])){
            
            $finalfile = $location . $_FILES["file"]['name'];
            if(move_uploaded_file($_FILES['file']['tmp_name'],$finalfile))
            {
                $profile = $_FILES["file"]['name'];
            }

        }
        echo $user->register($_POST['Firstname'],$_POST['Lastname'], $_POST['Username'], $_POST['Password'], $_POST['Email'], $_POST['Phone'], $profile);
    }

?>