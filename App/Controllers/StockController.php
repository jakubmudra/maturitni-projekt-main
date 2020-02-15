<?php


namespace App\Controllers;


use App\models\Db;
use App\models\Messages;
use App\models\Product;
use App\models\Stock;

class StockController extends Controller
{

    function process($params)
    {
        $this->checkSecurity();

        $productModel = new Product();
        $products = $productModel->getAll();
        $stockModel = new Stock();
        $stocks = $stockModel->getAll();


        if (!empty($params[1]) && $params[0] == 'remove')
        {
            $stockModel->removeStock($params[1]);
            Messages::addMessage("Stock succesfully removed");
            $this->redirect("stock");
        }

        if (isset($params[0])
            && $params[0] == "edit")
        {
            $this->setData("stock", ["id" => "","name" => "", "description" => "", "active" => ""]);
            $this->setData("products", $products);

            if( isset($_POST)
                && !empty($_POST['name'])
                && !empty($_POST['description'])
                && !empty($_POST['active'])) {

                $keys = ["name", "description", "active"];
                $stock = array_intersect_key($_POST, array_flip($keys));

                $stockModel->saveStock($stock, $_POST['id']);
                Messages::addMessage("Stock was saved");


                $stockID = ($_POST['id'] == '') ? Db::getLastId() : $_POST['id'];

                $productsArray = $_POST['products'] ?? [];

                foreach ($productsArray as $product)
                {
                    $data[] = ['product_id' => $product, 'stock_id' => $stockID, 'quantity' => 0];
                }

                $oldData = $stockModel->getProducts($stockID);
                $stockModel->cleanStock($stockID);
                if(!empty($data))
                    foreach ($oldData as $oldProduct)
                    {
                        foreach ($data as $id => $newProduct){
                            if ( $oldProduct["id"] == $newProduct["product_id"]){
                                $data[$id]["quantity"] = $oldProduct['quantity'];
                            }
                        }
                    }

                $stockModel->insertToStock($data);


                $this->redirect("stocktaking/" . $stockID);
            }

            if ($params[1] ?? null) {
                $stock = $stockModel->getSingle($params[1]);
                if ($stock) {
                    $this->setData("stock", $stock);
                    $this->setData("activeProducts", array_column($stockModel->getProducts($stock['id']), 'id'));
                }
            }

            $this->setTitle("Stock edit");#
            $this->setTemplate("stock/stock-edit");
        } else {
            $this->setData("stocks", $stocks);

            $this->setTitle("Stock");
            $this->setTemplate("stock/stockList");
        }
    }
}
