<?php


namespace App\Controllers;


use App\Libs\PosRenderer;
use App\models\EET;
use App\models\Transanction;

class TransactionController extends Controller
{
    function process($params)
    {
        $transactionModel = new Transanction();

        $action = $params[0] ?? null;
        if($action == "new")
            $this->redirect("transaction/" . $transactionModel->createTransaction());

        $posRenderer = new posRenderer(6,6);
        $posRenderer->addProducts($transactionModel->getProductToPOS());
        $this->setData("posRender",$posRenderer->renderTable() );
        $this->setData("transactionId", $params[0]);

        $this->setTitle("cash-register");
        $this->setTemplate("pos/transaction");
    }
}