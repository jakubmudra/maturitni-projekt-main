<?php


namespace App\Controllers;


class TestController extends Controller
{

    function process($params)
    {
        // TODO: Implement process() method.
        var_dump("kokot");
        $this->setTemplate("pos/layout");

    }
}