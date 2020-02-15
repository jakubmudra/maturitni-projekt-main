<?php


namespace App\Controllers;


class POSController extends Controller
{

    function process($params)
    {
        $this->setTitle("cash-register");
        $this->setTemplate("pos/layout");
    }
}
