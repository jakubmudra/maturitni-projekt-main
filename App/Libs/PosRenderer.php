<?php


namespace App\Libs;


use App\Config\Config;
use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;
use Twig\Loader\FilesystemLoader;

class PosRenderer
{
    public $cols;
    public $rows;
    public $products = [];
    public $table;
    public $type;

    public function __construct($c = 6, $r = 6, $type = "pos")
    {
        $this->rows = $r;
        $this->cols = $c;
        $this->type = $type;

        $loader = new FilesystemLoader(Config::$templateDirectory);
        $this->twig = new Environment($loader);
        $this->twig->addExtension(new IntlExtension());
        $this->twig->addExtension(new Translator());
    }


    private function getFunctionKeys()
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

        $this->preRenderTable();
    }

    public function preRenderTable()
    {
        for ($y = 1; $y <= $this->rows; $y++)
        {
            for ($x = 1; $x <= $this->cols; $x++)
            {
                $this->table[] = ["x" => $x, "y" => $y, "data" => ""];
            }
        }

        foreach ($this->products as $product)
        {
            $this->addToTable($product);
        }

        foreach ($this->getFunctionKeys() as $function)
        {
            $this->addFunctionsToTable($function);
        }

    }

    private function addToTable($product)
    {
        $product = (array) $product;
        $x = $product["x"];
        $y = $product["y"];
        $id = (($this->cols * $y ) - ($this->cols)  +  ($x-1));
        $this->table[$id]["type"] = "product";
        $this->table[$id]["data"] = $product;
        $this->table[$id]["data"]["color"] = "blue";

    }

    private function addFunctionsToTable($function)
    {
        $x = $function["position"]["x"];
        $y = $function["position"]["y"];
        $id = (($this->cols * $y ) - ($this->cols)  +  ($x-1));
        $this->table[$id]["type"] = "function";
        $this->table[$id]["data"] = $function;
    }


    public function renderTable()
    {
        $render = "";

        foreach ($this->table as $item) {


            $d = $item["type"] ?? null;

            if(!$d) {

            } elseif ($item["type"] == "function") {

            }

            if(!$d) {
                $render = $render . $this->twig->render("pos/items/empty" . Config::$templateFileExtension);
            }elseif ($item["type"] == "product") {
                $active = (is_array($item["data"]) > 0) ? "active" : "";
                $render = $render . $this->twig->render("pos/items/product" . Config::$templateFileExtension, ["item" => $item, "active" => $active]);
            } elseif ($item["type"] == "function") {
                $render = $render . $this->twig->render("pos/items/function" . Config::$templateFileExtension, ["item" => $item]);
            }

            $index = array_search($item,$this->table) + 1;
            if ($index % $this->cols == 0 && $index != 0)
            {
                $render = $render . '<div class="w-100"></div>';
            }

        }

        return $render;
    }
}