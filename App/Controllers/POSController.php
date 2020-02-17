<?php


namespace App\Controllers;


use App\models\Transanction;

class POSController extends Controller
{
    /**
     * @var TransactionController
     */
    private TransactionController $controller;

    function process($params)
    {
        $transaction = new Transanction();

        $action = $params[0] ?? null;
        $actionParram = $params[1] ?? null;

        $this->transaction = new Transanction();

        if ($action == 'transaction')
        {

        }


        $this->setTitle("cash-register");
        $this->setTemplate("pos/layout");
    }
}
