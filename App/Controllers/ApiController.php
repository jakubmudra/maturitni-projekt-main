<?php


namespace App\Controllers;


use App\models\Transanction;

class ApiController extends Controller
{

    function process($params)
    {
        header("Content-Type: application/json;charset=utf-8");

        // TODO: Implement process() method.
        $data = [];

        $transtactionModel = new Transanction();

        $action = $params[0] ?? null;

        if ( $action == "saveTransaction")
        {
            if( $_REQUEST){
              $action =  $_REQUEST["action"];

              if($action == "addProduct")
              {
                  $transactionID = $_REQUEST["trans_id"];
                  $productID =  $_REQUEST["product_id"];
                  $quantity =  $_REQUEST["quantity"];
                  $transtactionModel->saveProductToTransaction($productID, $transactionID, $quantity);
                  echo json_encode($_REQUEST);
              }elseif ($action == "getProducts"){
                  $transactionID = $_REQUEST["trans_id"];
                  $trans = $transtactionModel->getTransactionProducts($transactionID);
                  echo json_encode($trans);
              }
            }

        }


        die();
    }

}
