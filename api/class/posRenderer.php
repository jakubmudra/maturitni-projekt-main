<?php


class posRenderer {

    public $cols;
    public $rows;
    public $products = [];
    public $table;
    public $type;

    private $templates = [
        "singleItem" => "api/templates/singlePosItem.phtml",
        "singleItemFunction" => "api/templates/singlePosItemFunction.phtml",
        "singleItemPay" => "api/templates/singlePosItemPay.phtml",
        "wrap" => "api/templates/posItemWrap.phtml",
        'empty' => 'api/templates/empty.phtml'];

    public function __construct($c = 6, $r = 6, $type = "pos")
    {
        $this->rows = $r;
        $this->cols = $c;
        $this->type = $type;
    }

    private function _getPaymentKeys()
    {
        $paymentKeys = [
            [
                'id' => 1,
                'type' => 'number',
                'position' => ['x' => 1, 'y' => ($this->rows - 3 )],
                'value' => '1',
                'color' => 'dark-grey',
            ], [
                'id' => 2,
                'type' => 'number',
                'position' => ['x' => 2, 'y' => ($this->rows - 3 )],
                'value' => '2',
                'color' => 'dark-grey',
            ], [
                'id' => 3,
                'type' => 'number',
                'position' => ['x' => 3, 'y' => ($this->rows - 3 )],
                'value' => '3',
                'color' => 'dark-grey',
            ], [
                'id' => 4,
                'type' => 'number',
                'position' => ['x' => 1, 'y' => ($this->rows - 2 )],
                'value' => '4',
                'color' => 'dark-grey',
            ], [
                'id' => 5,
                'type' => 'number',
                'position' => ['x' => 2, 'y' => ($this->rows - 2 )],
                'value' => '5',
                'color' => 'dark-grey',
            ] , [
                'id' => 6,
                'type' => 'number',
                'position' => ['x' => 3, 'y' => ($this->rows - 2 )],
                'value' => '6',
                'color' => 'dark-grey',
            ], [
                'id' => 7,
                'type' => 'number',
                'position' => ['x' => 1, 'y' => ($this->rows - 1 )],
                'value' => '7',
                'color' => 'dark-grey',
            ], [
                'id' => 8,
                'type' => 'number',
                'position' => ['x' => 2, 'y' => ($this->rows - 1 )],
                'value' => '8',
                'color' => 'dark-grey',
            ], [
                'id' => 9,
                'type' => 'number',
                'position' => ['x' => 3, 'y' => ($this->rows - 1 )],
                'value' => '7',
                'color' => 'dark-grey',
            ], [
                'id' => 10,
                'type' => 'clearNumber',
                'position' => ['x' => 1, 'y' => ($this->rows )],
                'value' => 'C',
                'color' => 'dark-grey',
            ], [
                'id' => 11,
                'type' => 'number',
                'position' => ['x' => 2, 'y' => ($this->rows )],
                'value' => '0',
                'color' => 'dark-grey',
            ], [
                'id' => 12,
                'type' => 'number',
                'position' => ['x' => 3, 'y' => ($this->rows )],
                'value' => '00',
                'color' => 'dark-grey',
            ], [
                'id' => 13,
                'type' => 'number',
                'position' => ['x' => 4, 'y' => ($this->rows - 3 )],
                'value' => '100',
                'color' => 'blue',
            ], [
                'id' => 14,
                'type' => 'number',
                'position' => ['x' => 5, 'y' => ($this->rows - 3 )],
                'value' => '200',
                'color' => 'blue',
            ], [
                'id' => 15,
                'type' => 'number',
                'position' => ['x' => 4, 'y' => ($this->rows - 2 )],
                'value' => '500',
                'color' => 'blue',
            ], [
                'id' => 16,
                'type' => 'number',
                'position' => ['x' => 5, 'y' => ($this->rows - 2 )],
                'value' => '1000',
                'color' => 'blue',
            ], [
                'id' => 17,
                'type' => 'number',
                'position' => ['x' => 4, 'y' => ($this->rows - 1 )],
                'value' => '2000',
                'color' => 'blue',
            ], [
                'id' => 18,
                'type' => 'number',
                'position' => ['x' => 5, 'y' => ($this->rows - 1)],
                'value' => '5000',
                'color' => 'blue',
            ]
        ];

        return $paymentKeys;
    }

    private function _getFunctionKeys()
    {
        $functionKeys = [
            [
                'id' => 1,
                'displayName' => 'Pay',
                'position' => ['x' => $this->cols, 'y' => $this->rows],
                'colSpan' => 2,
                'jsEvent' => 'payment',
                'color' => 'green',
                'authRequired' => false
            ],
            [
                'id' => 2,
                'displayName' => 'Cancel',
                'position' => ['x' => 5, 'y' => $this->rows],
                'jsEvent' => 'cancelOrders',
                'color' => 'dark-red',
                'authRequired' => true
            ],
            [
                'id' => 3,
                'displayName' => 'Manazer',
                'position' => ['x' => $this->cols, 'y' => 1],
                'jsEvent' => 'managerMenu',
                'color' => 'red',
                'authRequired' => true
            ],
            [
                'id' => 4,
                'displayName' => 'Mnozstvi',
                'position' => ['x' => $this->cols, 'y' => 2],
                'jsEvent' => 'managerMenu',
                'color' => 'grey',
                'authRequired' => true
            ],
            [
                'id' => 5,
                'displayName' => 'Velikost',
                'position' => ['x' => $this->cols, 'y' => 3],
                'jsEvent' => 'managerMenu',
                'color' => 'grey',
                'authRequired' => true
            ],
            [
                'id' => 4,
                'displayName' => 'Ingredience',
                'position' => ['x' => $this->cols, 'y' => 4],
                'jsEvent' => 'managerMenu',
                'color' => 'grey',
                'authRequired' => true
            ],
            [
                'id' => 4,
                'displayName' => 'Odstranit polozku',
                'position' => ['x' => 1, 'y' => $this->rows],
                'jsEvent' => 'managerMenu',
                'color' => 'red',
                'authRequired' => true
            ],
            [
                'id' => 4,
                'displayName' => 'Odlozit ucet',
                'position' => ['x' => 4, 'y' => $this->rows],
                'jsEvent' => 'managerMenu',
                'color' => 'orange',
                'authRequired' => true
            ]
        ];

        return $functionKeys;
    }






    public function addProducts($products)
    {
        if(is_array($products) && !empty($products))
        {
            $this->products = $products;
        }

        $this->_preRenderTable();
    }

    public function _preRenderTable()
    {
        for ($y = 1; $y <= $this->rows; $y++)
        {
            for ($x = 1; $x <= $this->cols; $x++)
            {
                $this->table[] = ["x" => $x, "y" => $y, "data" => ""];
            }
        }

        if($this->type == "pos")
        {
            foreach ($this->products as $product)
            {
                $this->_addToTable($product);
            }

            foreach ($this->_getFunctionKeys() as $function)
            {
                $this->_addFunctionsToTable($function);
            }
        } elseif ($this->type == "pay")
        {
            foreach ($this->_getPaymentKeys() as $function)
            {
                $this->_addPayToTable($function);
            }
        }

    }

    private function _addToTable(product $product)
    {
        $product = (array) $product;
        $x = $product["position"]["x"];
        $y = $product["position"]["y"];
        $id = (($this->cols * $x ) - ($this->cols)  +  ($y-1));
        $this->table[$id]["type"] = "product";
        $this->table[$id]["data"] = $product;
    }

    private function _addFunctionsToTable($function)
    {
        $x = $function["position"]["x"];
        $y = $function["position"]["y"];
        $id = (($this->cols * $y ) - ($this->cols)  +  ($x-1));
        $this->table[$id]["type"] = "function";
        $this->table[$id]["data"] = $function;
    }

    private function _addPayToTable($function)
    {
        $x = $function["position"]["x"];
        $y = $function["position"]["y"];
        $id = (($this->cols * $y ) - ($this->cols)  +  ($x-1));
        $this->table[$id]["type"] = "pay";
        $this->table[$id]["data"] = $function;
    }

    public function renderTable()
    {
        $render = "";
        $return = [];

        foreach ($this->table as $item) {

            if ($item["type"] == "product") {

                $active = (is_array($item["data"]) > 0) ? true : false;
                ob_start();
                include($this->templates["singleItem"]);
                $render = $render . ob_get_contents();
                ob_end_clean();
            } elseif ($item["type"] == "function") {
                ob_start();
                include($this->templates["singleItemFunction"]);
                $render = $render . ob_get_contents();
                ob_end_clean();
            }elseif ($item["type"] == "pay") {
                ob_start();
                include($this->templates["singleItemPay"]);
                $render = $render . ob_get_contents();
                ob_end_clean();
            } else {
                ob_start();
                include($this->templates["empty"]);
                $render = $render . ob_get_contents();
                ob_end_clean();
            }

            $index = array_search($item,$this->table) + 1;
            if ($index % $this->cols == 0 && $index != 0)
            {
                $render = $render . file_get_contents($this->templates["wrap"]);
            }

        }

        return $render;
    }

}
