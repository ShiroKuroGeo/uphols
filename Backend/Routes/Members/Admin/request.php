<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/requestController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function getInfoRequest(){
        $request = new requestController();

        echo $request->getInfoRequest();
    }

    function getAllInfoRequest(){
        $request = new requestController();

        echo $request->getAllInfoRequest($_POST['ID']);
    }

    function updateStatus(){
        $request = new requestController();

        echo $request->updateStatus($_POST['id'], $_POST['status'], $_POST['dateDeliver'], $_POST['gmail']);
    }

    function getDateAndTotalId(){
        $request = new requestController();

        echo $request->getDateAndTotalId();
    }
    
    function doStoreScheduleRepairFunction(){
        $request = new requestController();

        echo $request->doStoreScheduleRepairFunction($_POST['id'], $_POST['Types'], $_POST['Color'], $_POST['Fabric'], $_POST['Message'], $_POST['paymentMethod'], $_POST['paymentTotalPrice'], $_POST['date']);
    }

?>