<?php

class TestingController extends BaseController
{
    public function testingAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        // echo json_encode($requestMethod);
        return "Success...";
        
    }
}
?>