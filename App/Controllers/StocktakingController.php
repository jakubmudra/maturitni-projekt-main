<?php


namespace App\Controllers;


use App\Libs\Formater;
use App\Libs\PDF;
use App\models\Messages;
use App\models\Product;
use App\models\Stock;

class StocktakingController extends Controller
{
    public function process($params)
    {
        $this->checkSecurity();

        if (!isset($params[0])) {
            Messages::addMessage("Unathorized", "error");
            $this->redirect("stock");
        }
        $stockId = $params[0];

        $stockModel = new Stock();
        $productModel = new Product();
        $stock = $stockModel->getSingle($stockId);

        if (!$stock) {
            Messages::addMessage("Stock not found", "error");
            $this->redirect("stock");
        }

        $products = $stockModel->getProducts($stockId);
        $this->setData("items", $products);
        $this->setData("stockId", $stockId);


        if(isset($params[1])
        && $params[1] == "edit"){
            $allProducts = Formater::stockProductDiff($products, $productModel->getAll());
            $allProducts = array_map(   fn($el) => [$el["id"], $el["name"]], $allProducts);

            $this->setData("allProducts", $allProducts);

            if( isset($_POST["submit"]) ){
                $arg = ["stock_id" => $stockId, "product_id" => "", "quantity" => ""];
                unset($_POST["submit"]);

                foreach ($_POST as $key => $value) {
                    $arg["product_id"] = $key;
                    $arg["quantity"] = $value;
                    $stockModel->updateQuantity($arg);
                }
                Messages::addMessage("Inventura zapracovana", "success");
                $this->redirect("stocktaking/" . $stockId);
            }

            $this->setTitle("Stock taking edit");
            $this->setTemplate("stock/stockTakingEdit");
        }else {
            $this->setTitle("Stock taking");
            $this->setTemplate("stock/stockTaking");

        }




    }
}
