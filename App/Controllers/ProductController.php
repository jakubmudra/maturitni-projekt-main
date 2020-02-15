<?php


namespace App\Controllers;


use App\Config\Config;
use App\models\Db;
use App\models\Messages;
use App\models\Product;

class ProductController extends Controller
{

    function process($params)
    {
        // TODO: Implement process() method.
        $this->checkSecurity();
        $productModel = new Product();

        if (!empty($params[1]) && $params[0] == 'remove')
        {
            $productModel->removeProduct($params[1]);
            Messages::addMessage("Product succesfully removed");
            $this->redirect("product");
        }

        $products = $productModel->getAll();
        $this->setData("products", $products);
        $this->setData("types", $productModel->getTypes());


        if (isset($params[0])
            && $params[0] == "edit")
        {
            $this->setData("product", ["id" => "","name" => "", "price" => "", "type" => ""]);
            $this->setData("maxPosition", Config::$maxPositions);

            if( isset($_POST)
                && !empty($_POST['name'])
                && !empty($_POST['price'])
                && !empty($_POST['type'])) {

                $keys = ["name", "price", "type"];
                $product = array_intersect_key($_POST, array_flip($keys));

                $productModel->saveProduct($product, $_POST['id']);

                $productID = ($_POST['id'] == '') ? Db::getLastId() : $_POST['id'];

                if ($_POST['xPos'] != "--"
                    && $_POST['yPos'] != "--" ){
                    $productModel->saveMeta("xPos",$_POST["xPos"],   $productID);
                    $productModel->saveMeta("yPos",$_POST["yPos"],   $productID);
                }

                Messages::addMessage("Product was saved");
                $this->redirect("product");
            }

            if (isset($params[1])) {
                $product = $productModel->getSingle($params[1]);
                if ($product) {
                    $this->setData("product", $product);
                    $this->setData("xPos", $productModel->getMeta("xPos", $params[1]));
                    $this->setData("yPos", $productModel->getMeta("yPos", $params[1]));
                }
            }

            $this->setTitle("Product edit");#
            $this->setTemplate("product/product-edit");
        } else {
            $this->setData("productModel", $productModel);

            $this->setTitle("Product List");#
            $this->setTemplate("product/productList");
        }


    }
}
