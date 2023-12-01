<?php
    session_start();
    
    if(isset($_SESSION['user_id'])){
        if(!$role){
            header("location: /uphols/Backend/Routes/Logout.php");
        }else if($role == 1){
            header("location: /uphols/Frontend/Public/Users/Admin/index.php");
        }else if($role == 2){
            header("location: /uphols/Frontend/Public/Users/Members/Employee/index.php");
        }else if($role == 3){
            header("location: /Uphols/Frontend/Public/Users/Members/Customer/profile.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upholstery - <?php echo $pageTitle; ?></title>
    <!-- The aos or the animation on scroll in minified css -->
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Aos/Aos.min.css">
    <!-- Styles or the design styles css of the system -->
    <link rel="stylesheet" href="/uphols/Assets/Css/theme.min.css">
    <!-- Used in multisteps in register -->
    <link rel="stylesheet" href="/uphols/Assets/Css/multistep.css">
    <!-- The functions css -->
    <link rel="stylesheet" href="/uphols/Assets/Css/functions.css">
    <!-- fontawesome kit or the Icon in Fontawesome -->
    <script src="https://kit.fontawesome.com/d41feec2f9.js" crossorigin="anonymous"></script>
    <!-- Font awesome or the Icons of bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- The Css of toastr -->
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastr.min.css">
    <!-- The color of toastr -->
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastrColor.css">
    <!-- The style of custom -->
    <link rel="stylesheet" href="/uphols/Assets/Css/authCustom.css">
</head>
<body>
    <!-- Start of the Header Code -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-uph">
        <div class="container px-5">
            <a class="navbar-brand" href="../index.php"><img src="/uphols/Assets/Images/mainLogo.png" alt="Upholstery Logo" width="80"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        </div>
    </nav>
    <!-- End of the Header Code -->