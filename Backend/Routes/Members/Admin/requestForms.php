<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/requestformsController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function storeCustomization(){
        $requestforms = new requestformsController();
        
        echo $requestforms->storeCustomization($_POST['Types'], $_POST['TypesPrice'], $_POST['color'], $_POST['colorPrice'], $_POST['fabric'], $_POST['fabricPrice']);
    }
    
    function getSelectAllRequestForms(){
        $requestforms = new requestformsController();

        echo $requestforms->getSelectAllRequestForms();
    }

    function deleteDesignId(){
        $requestforms = new requestformsController();

        echo $requestforms->deleteDesignId($_POST['designId']);
    }
    
    function updateDesignId(){
        $requestforms = new requestformsController();

        echo $requestforms->updateDesignId($_POST['typesUpdate'], $_POST['TypesPriceUpdate'], $_POST['colorUpdate'], $_POST['colorPriceUpdate'], $_POST['fabricUpdate'], $_POST['fabricPriceUpdate'], $_POST['designId']);
    }

?>