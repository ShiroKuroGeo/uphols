<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/recommendationController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function selectAllRecommendation(){
        $recommend = new recommendationController();
        echo $recommend->selectAllRecommendation();
    }

    function selectedRecommend(){
        $recommend = new recommendationController();
        echo $recommend->selectedRecommend($_POST['recommend_id']);
    }

    function recommendation(){
        $recommend = new recommendationController();
        echo $recommend->recommendation($_POST['Fullname'], $_POST['Email'], $_POST['Phone'], $_POST['Message']);
    }

    function countAllRecommendation(){
        $recommend = new recommendationController();
        echo $recommend->countAllRecommendation();
    }

?>